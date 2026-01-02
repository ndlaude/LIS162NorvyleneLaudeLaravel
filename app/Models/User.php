<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'usertype_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Accessor for name attribute
    public function getNameAttribute()
    {
        return $this->full_name;
    }

    // Relationships
    public function userType()
    {
        return $this->belongsTo(Usertype::class, 'usertype_id', 'usertype_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id', 'user_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'doctor_id', 'user_id');
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'doctor_dept', 'doctor_id', 'department_id');
    }
}