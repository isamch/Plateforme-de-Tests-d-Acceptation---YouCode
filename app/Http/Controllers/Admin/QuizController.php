<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Quiz;
use App\Models\Question;

use App\Http\Requests\Quiz\UpdateRequest;
use App\Http\Requests\Quiz\AddRequest;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::withTrashed()->orderBy('id', 'desc')->get();
        return view('admin.quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions = Question::all();
        return view('admin.quizzes.create', compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddRequest $request)
    {
        $quiz = Quiz::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
        ]);

        if ($request->has('question_ids')) {
            $quiz->questions()->attach($request->question_ids);
        }

        return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        return view('admin.quizzes.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        $questions = Question::all();
        return view('admin.quizzes.edit', compact('quiz', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $quiz = Quiz::findOrFail($id);

        $quiz->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        $quiz->questions()->sync($request->question_ids ?? []);

        return redirect()->route('quizzes.show', $quiz->id)->with('success', 'Quiz updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        // return redirect()->route('quizzes.index')->with('success', 'Quiz deleted successfully!');
        return response()->json(['success' => 'Quiz restored successfully!']);

    }

    public function restore($id)
    {
        $quiz = Quiz::withTrashed()->findOrFail($id);
        $quiz->restore();

        // return redirect()->route('quizzes.index')->with('success', 'Quiz restored successfully!');
        return response()->json(['success' => 'Quiz restored successfully!']);

    }

    // mine :
    public function toggleStatus(Quiz $quiz)
    {
        $quiz->update([
            'status' => $quiz->status === 'active' ? 'not_active' : 'active',
        ]);
        return redirect()->route('quizzes.index')->with('success', 'Quiz status updated successfully!');
    }
}
