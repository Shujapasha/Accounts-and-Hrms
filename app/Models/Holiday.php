<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $table = 'hrm_holidays';
    protected $fillable = [
        'date',
        'occasion',
        'created_by',
    ];
}
