<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingEmployee extends Model
{
    protected $table = 'hrm_meeting_employees';
    protected $fillable = [
        'meeting_id',
        'employee_id',
        'created_by',
    ];
}
