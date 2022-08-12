<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoalType extends Model
{
    protected $table = 'hrm_goal_types';
    protected $fillable = [
        'name',
        'created_by',
    ];
}
