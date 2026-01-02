<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
   
    protected $table = 'departments';
    protected $fillable = [
        'location', 'department_name'
    ];

    public function doctor_dept(): HasMany
    {
        return $this->hasMany(Doctor_Dept::class);
    }
}


