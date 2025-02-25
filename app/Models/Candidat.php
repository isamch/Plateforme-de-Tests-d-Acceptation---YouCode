<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;

    protected $table = 'candidats';

    protected $fillable = ['card_path', 'user_id'];


    // relationship:
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function candidatQuizzes()
    {
        return $this->hasOne(CandidatQuiz::class);
    }



}
