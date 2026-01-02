<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';
    public $timestamps = true;
    protected $primaryKey = 'schedule_id';
    
    // A Schedule belongs to one Doctor (User)
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'user_id');
    }

    // A Schedule slot can have many Appointments over different dates
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'schedule_id', 'schedule_id');
    }
}
