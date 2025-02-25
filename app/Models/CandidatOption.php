<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidatOption extends Model
{
    use HasFactory;

    protected $table = 'candidat_options';

    protected $fillable = ['candidat_quiz_id', 'option_id', 'is_true'];



    // relationship:
    public function candidatQuiz()
    {
        return $this->belongsTo(CandidatQuiz::class);
    }


    // options:
    public function option()
    {
        return $this->belongsTo(Option::class);
    }



}
