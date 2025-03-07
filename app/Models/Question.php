<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = ['question'];



    // relationship:

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class, 'question_quiz');
    }


    public function options()
    {
        return $this->hasMany(Option::class);
    }


    public function correctOption()
    {
        return $this->hasOne(Option::class)->where('is_true', true);
    }
}
