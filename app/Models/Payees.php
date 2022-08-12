<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payees extends Model
{
    protected $table = 'hrm_payees';
    protected $fillable = [
        'payee_name',
        'contact_number',
        'created_by',
    ];
}
