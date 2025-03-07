<?php

namespace App\Http\Controllers\Candidat;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\TestScheduledMail;
use App\Models\Candidat;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\CandidatQuiz;
use App\Models\CandidatOption;
use App\Models\Staff;
use App\Models\StaffEvent;
use App\Models\TestPresentiel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class QuizController extends Controller
{


    public function index()
    {
        $quiz = Quiz::where('status', 'active')->firstOrFail();
        return view('candidat.quiz.index', compact('quiz'));
    }


    public function start()
    {

        $quiz = Quiz::where('status', 'active')->firstOrFail();


        $candidatQuiz = CandidatQuiz::create([
            'score' => 0,
            'status' => 'in_progress',
            'candidat_id' => Auth::user()->candidat->id,
            'quiz_id' => $quiz->id,
            'start_time' => now(),
        ]);


        // return view('candidat.quiz.start', compact('quiz'));
        return view('candidat.quiz.start', compact('quiz', 'candidatQuiz'));
    }


    public function submit(Request $request)
    {
        $candidatQuiz = CandidatQuiz::where('candidat_id', Auth::user()->candidat->id)->latest()->firstOrFail();

        $score = 0;

        $answers = $request->answers ?? [];
        foreach ($answers as $index => $answer) {
            $question = Question::find($index);
            $is_ture = false;
            if ($question->options->where('is_true', true)->first()->id == $answer) {
                $score++;
                $is_ture = true;
            }
            CandidatOption::create([
                'candidat_quiz_id' => $candidatQuiz->id,
                'option_id' => $answer,
                'is_true' => $is_ture,
            ]);
        }

        $candidatQuiz->update([
            'status' => 'completed',
            'end_time' => now(),
            'score' => $score,
        ]);

        // callcule moyenne :
        $totalQuestions = $candidatQuiz->quiz->questions->count();

        $moyenne = ($score / $totalQuestions) * 20;

        if ($moyenne >= 10) {
            $this->scheduleTestPresentiel();
        }

        return redirect()->route('verification.message')->with('message', 'You passed the Quiz. Check Your Email');
    }


    private function forceSubmit($candidatQuiz)
    {
        CandidatQuiz::where('id', $candidatQuiz->id)->update([
            'status' => 'completed',
            'end_time' => now(),
        ]);

        return redirect()->route('verification.message')->with('message', 'Time is up! Your quiz was submitted automatically.');
    }


    // Schedule Test Presentiel:

    public function scheduleTestPresentiel()
    {
        date_default_timezone_set('Africa/Casablanca');

        $candidat = Auth::user()->candidat;
        $candidatQuizzes = $candidat->candidatQuizzes;
        $staffMembers = Staff::all();

        foreach ($staffMembers as $staff) {

            $testDate = $this->calculateTestDate($candidatQuizzes);

            $startLimit = $testDate->copy();
            $endLimit = $startLimit->copy()->addDay();

            $testDate = $this->findAvailableTestDate($staff, $testDate, $startLimit, $endLimit);

            if ($testDate) {
                $this->assignTestToStaff($candidat, $staff, $testDate);
                break;
            }
        }
    }

    // Private Methods:

    private function findAvailableTestDate($staff, $testDate, $startLimit, $endLimit)
    {
        do {

            $testDate = $this->modifyDateTestForWorkTime($testDate);

            $conflict = $this->checkForStaffConflict($staff, $testDate);

            if ($conflict) {
                $testDate = $this->modifyDateForConfilct($conflict);
            }

            if ($testDate->greaterThan($endLimit)) {
                break;
            }
        } while ($conflict);

        return (!$conflict && $testDate->lessThanOrEqualTo($endLimit)) ? $testDate : null;
    }

    private function calculateTestDate($candidatQuizzes)
    {
        $testDate = Carbon::parse($candidatQuizzes->end_time)->addWeek();
        return $this->roundToNearestHour($testDate);
    }

    private function roundToNearestHour($time)
    {
        $date = Carbon::parse($time);

        if ($date->minute >= 30) {
            $date->addHour()->minute(0)->second(0);
        } else {
            $date->minute(0)->second(0);
        }

        return $date;
    }

    private function modifyDateTestForWorkTime($testDate)
    {
        if ($testDate->hour < 8) {
            $testDate->setHour(8);
        } elseif ($testDate->hour >= 12 && $testDate->hour < 14) {
            $testDate->setHour(14);
        } elseif ($testDate->hour >= 17) {
            $testDate->addDay()->setHour(8);
        }

        while ($testDate->isWeekend()) {
            $testDate->addDay();
        }

        return $testDate;
    }

    // Check Conflict:

    private function checkForStaffConflict($staff, $testDate)
    {
        return $staff->staffEvents()
            ->where('start_time', '<', $testDate->copy()->addMinutes(30))
            ->where('end_time', '>', $testDate)
            ->value('end_time');
        // ->exists();
    }

    private function modifyDateForConfilct($conflict)
    {
        $testDate = Carbon::parse($conflict);

        if ($testDate->hour >= 12 && $testDate->hour < 14) {
            $testDate->setHour(14);
        } elseif ($testDate->hour >= 17) {
            $testDate->addDay()->setHour(8);
        }

        return $testDate;
    }

    private function assignTestToStaff($candidat, $staff, $testDate)
    {

        // add in presentiel table :
        TestPresentiel::create([
            'title' => 'test presentiel for ' . $candidat->user->first_name,
            'staff_id' => $staff->id,
            'candidat_id' => $candidat->id,
            'start_time' => $testDate,
            'end_time' => $testDate->copy()->addMinutes(30),
        ]);


        // add in staffEvent table :
        $staffEvent = StaffEvent::create([
            'title' => 'test presentiel for ' . $candidat->user->first_name,
            'start_time' => $testDate,
            'end_time' => $testDate->copy()->addMinutes(30),
        ]);

        $staff->staffEvents()->attach($staffEvent->id);


        // send email:
        Mail::to($candidat->user->email)->send(new TestScheduledMail($candidat, $testDate));


    }
}
