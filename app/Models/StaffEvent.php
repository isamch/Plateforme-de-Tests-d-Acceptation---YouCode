<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffEvent extends Model
{
    use HasFactory;

    protected $table = 'staff_events';

    protected $fillable = ['title', 'start_time', 'end_time'];




    // relation :
    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'staff_staff_event');
    }


}
