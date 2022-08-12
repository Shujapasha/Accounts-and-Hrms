<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $table = 'hrm_payment_types';
    protected $fillable = [
        'name',
        'created_by',
    ];
}
