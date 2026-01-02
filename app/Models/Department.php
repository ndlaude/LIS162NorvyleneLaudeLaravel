<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $table = 'departments';
    protected $primaryKey = 'department_id';
    protected $fillable = [
        'location', 'department_name'
    ];

    public function doctors()
    {
        return $this->belongsToMany(User::class, 'doctor_dept', 'department_id', 'doctor_id');
    }
}


