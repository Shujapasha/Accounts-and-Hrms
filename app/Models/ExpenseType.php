<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseType extends Model
{
    protected $table = 'hrm_expense_types';
    protected $fillable = [
        'expense_type',
        'created_by',
    ];
}
