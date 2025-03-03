<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Quiz;
use App\Models\Question;


class QuizQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $quizzes = Quiz::all();
        // $questions = Question::pluck('id')->toArray();

        // if ($quizzes->count() == 0 || $questions->count() == 0) {
            // return;
        // }



        // foreach ($quizzes as $quiz) {

            $quizzes[1]->questions()->syncWithoutDetaching([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

            $quizzes[2]->questions()->syncWithoutDetaching([11, 12, 13, 14, 15, 16, 17, 18, 19, 20]);

        // }



    }
}
