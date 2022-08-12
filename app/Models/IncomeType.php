<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeType extends Model
{
    protected $table = 'hrm_income_types';
    protected $fillable = [
        'income_type',
        'created_by',
    ];
}
