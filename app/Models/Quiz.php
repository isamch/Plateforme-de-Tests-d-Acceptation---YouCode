<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quizzes';

    protected $fillable = ['title', 'description', 'user_id'];



    // relationship:

    // who create this quiz
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_quiz');
    }


    // who take this quiz
    public function candidatQuizzes()
    {
        return $this->hasMany(CandidatQuiz::class);
    }



}
