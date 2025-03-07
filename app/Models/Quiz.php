<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'quizzes';

    protected $fillable = ['title', 'description', 'user_id', 'status'];

    protected $dates = ['deleted_at'];

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
