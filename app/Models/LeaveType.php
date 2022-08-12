<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $table = 'hrm_leave_types';
    protected $fillable = [
        'title',
        'days',
        'created_by',
    ];
}
