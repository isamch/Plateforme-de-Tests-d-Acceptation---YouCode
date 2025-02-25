<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $table = 'options';


    protected $fillable = ['option', 'question_id', 'is_true'];



    // relationship:

    public function question()
    {
        return $this->belongsTo(Question::class);
    }


    public function candidatOption()
    {
        return $this->hasMany(CandidatOption::class);
    }


}
