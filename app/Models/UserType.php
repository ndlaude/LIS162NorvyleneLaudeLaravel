<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usertype extends Model
{
    protected $table = 'usertype';
    protected $primaryKey = 'usertype_id';
    protected $fillable = ['usertype_name'];
}