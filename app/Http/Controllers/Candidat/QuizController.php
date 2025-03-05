<?php

namespace App\Http\Controllers\Candidat;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Candidat;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\CandidatQuiz;
use App\Models\CandidatOption;

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

        CandidatQuiz::create([
            'score' => 0,
            'status' => 'in_progress',
            'candidat_id' => Auth::user()->candidat->id,
            'quiz_id' => $quiz->id,
        ]);

        return view('candidat.quiz.start', compact('quiz'));
    }


    public function submit(Request $request)
    {

        $candidatQuiz = CandidatQuiz::where('candidat_id', Auth::user()->candidat->id)->latest()->firstOrFail();
        $quiz = Quiz::find($candidatQuiz->quiz_id);

        // duration :
        $startTime = strtotime($candidatQuiz->start_time);
        $currentTime = time();
        $elapsedTime = ($currentTime - $startTime) / 60;

        if ($elapsedTime >= $quiz->duration) {
            return $this->forceSubmit($candidatQuiz);
        }

        $score = 0;
        foreach ($request->answers as $index => $answer) {
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

        return redirect()->route('verification.message')->with('message', 'You I passed the Quiz.');
    }


    private function forceSubmit($candidatQuiz)
    {
        CandidatQuiz::where('id', $candidatQuiz->id)->update([
            'status' => 'completed',
            'end_time' => now(),
        ]);

        return redirect()->route('verification.message')->with('message', 'Time is up! Your quiz was submitted automatically.');
    }

}
