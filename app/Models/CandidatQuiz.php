<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidatQuiz extends Model
{
    use HasFactory;

    protected $table = 'candidat_quizzes';

    protected $fillable = ['score', 'status', 'candidat_id', 'quiz_id', 'start_time', 'end_time'];



    // relationship:

    public function candidat()
    {
        return $this->belongsTo(Candidat::class);
    }


    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }



    // candidat options :
    public function candidatOption()
    {
        return $this->hasMany(CandidatOption::class);
    }





}



