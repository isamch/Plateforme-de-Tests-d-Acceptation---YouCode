<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;


    protected $table = 'staff';

    protected $fillable = [
        'speciality',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }



    // testpresentiel :
    public function TestPresentiels()
    {
        return $this->hasMany(TestPresentiel::class);
    }

    public function staffEvents()
    {
        return $this->belongsToMany(StaffEvent::class, 'staff_staff_event');
    }


}
