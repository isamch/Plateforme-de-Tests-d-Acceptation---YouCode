<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

use App\Http\Requests\Question\storeRequest;
use App\Models\Option;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        return view('admin.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeRequest $request)
    {
        $question = Question::create(['question' => $request->question]);

        foreach ($request->options as $index => $option) {

            $is_true = false;
            if ($index == $request->correct_option) {
                $is_true = true;
            }

            Option::create([
                'option' => $option,
                'question_id' => $question->id,
                'is_true' => $is_true,
            ]);
        }

        return redirect()->route('questions.index')->with('success', 'Question added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return view('admin.questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('admin.questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(storeRequest $request, Question $question)
    {

        $question->update(['question' => $request->question]);

        $question->options()->delete();

        foreach ($request->options as $index => $option) {
            $is_true = ($index == $request->correct_option);

            Option::create([
                'option' => $option,
                'question_id' => $question->id,
                'is_true' => $is_true,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->options()->delete();
        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Question deleted successfully');
    }
}
