<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeductionOption extends Model
{
    protected $table = 'hrm_deduction_options';
    protected $fillable = [
        'name',
        'created_by',
    ];
}
