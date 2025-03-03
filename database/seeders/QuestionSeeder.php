<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Quiz;

use App\Models\Question;


class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\Question::factory(10)->create();

        $questions = [
            "What does HTML stand for?",
            "Which tag is used to create a hyperlink in HTML?",
            "What does CSS stand for?",
            "Which of the following is used to add styling to a webpage?",
            "Which HTML tag is used to define an unordered list?",
            "What is the correct file extension for a JavaScript file?",
            "How do you create a function in JavaScript?",
            "Which of the following is a JavaScript framework?",
            "What property is used to change text color in CSS?",
            "How do you comment in HTML?",
            "Which of the following is NOT a programming language?",
            "Which unit is relative to the font size of an element?",
            "Which CSS property is used to make text bold?",
            "What does `float: left;` do in CSS?",
            "How do you add a background color in CSS?",
            "Which of these is NOT a valid HTML5 element?",
            "What does the `<meta charset='UTF-8'>` tag do?",
            "Which CSS property controls text size?",
            "What does JavaScript mainly run on?",
            "Which of the following is a correct way to add an external CSS file to an HTML page?"
        ];


        foreach ($questions as $question) {
            Question::create([
                'question'=> $question,
            ]);
        }



    }
}
