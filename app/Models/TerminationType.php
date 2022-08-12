<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TerminationType extends Model
{
    protected $table = 'hrm_termination_types';
    protected $fillable = [
        'name',
        'created_by',
    ];
}
