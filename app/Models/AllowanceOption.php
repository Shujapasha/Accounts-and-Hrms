<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllowanceOption extends Model
{
    protected $table = 'hrm_allowance_options'; 
    protected $fillable = [
        'name',
        'created_by',
    ];
}
