<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestPresentiel extends Model
{
    use HasFactory;

    protected $table = 'test_presentiels';

    protected $fillable = ['title', 'staff_id', 'candidat_id', 'start_time', 'end_time'];




    // relation :
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function candidat()
    {
        return $this->belongsTo(Candidat::class);
    }

}
