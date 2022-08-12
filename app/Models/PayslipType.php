<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayslipType extends Model
{
    protected $table = 'hrm_payslip_types';
    protected $fillable = [
        'name',
        'created_by',
    ];
}
