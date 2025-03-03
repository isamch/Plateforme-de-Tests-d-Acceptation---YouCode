<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Question;

class QuestionFactory extends Factory
{


    protected $model = Question::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        return [
            'question' => $this->faker->sentence(),
        ];
    }
}
