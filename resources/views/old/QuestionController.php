<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Question;
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
    public function store(Request $request)
    {

        // "question" => "gyuhjioklp"
        // "options" => array:4 [▼
        //   0 => "zas"
        //   1 => "uygh"
        //   2 => "dazd"
        //   3 => "adzazd"
        // ]
        // "correct_option" => "1"

        $validated = $request->validate([
            'question' => 'required|string|min:3|max:255',
            'options' => 'required|array|min:2|max:4',
            'options.*' => 'required|string|min:1|max:255',
            'correct_option' => 'required|integer|min:0|max:3',
        ]);

        $credentials = [
            'question' => $request->question,
            'options' => $request->options,
            'correct_option' => $request->correct_option,
        ];


        dd($credentials);

        $question = Question::create([
            'question' => $validated['question'],
        ]);

        foreach ($validated['options'] as $index => $optionValue) {

            $is_correct = false;
            if ($index == $validated['correct_option']) {
                $is_correct = true;
            }


            Option::create([
                'question_id' => $question->id,
                'option' => $optionValue,
                'is_correct' => $is_correct,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        return view('admin.questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        return view('admin.questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
