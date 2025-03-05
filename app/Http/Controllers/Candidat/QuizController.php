<?php

namespace App\Http\Controllers\Candidat;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{


    public function index()
    {
        $quiz = Quiz::where('status','active')->firstOrFail();
        return view('candidat.quiz.index', compact('quiz'));
    }


    public function start()
    {
        $quiz = Quiz::where('status','active')->firstOrFail();
        return view('candidat.quiz.start', compact('quiz'));
    }


    public function submit(Request $request)
    {
        dd($request->answers);

        $score = 0;

        foreach ($$request->answers as $index => $answer) {


        }




    }





}
