<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanOption extends Model
{
    protected $table = 'hrm_loan_options';
    protected $fillable = [
        'name',
        'created_by',
    ];
}
