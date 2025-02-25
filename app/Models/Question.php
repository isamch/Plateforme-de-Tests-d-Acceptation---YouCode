<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = ['question', 'quiz_id'];



    // relationship:

    public function quiz()
    {
        return $this->belongsToMany(Quiz::class, 'question_quiz');
    }


    public function options()
    {
        return $this->hasMany(Option::class);
    }

}
