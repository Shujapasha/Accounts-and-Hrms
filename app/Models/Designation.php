<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $table = 'hrm_designations';
    protected $fillable = [
        'department_id','name','created_by'
    ];
}
