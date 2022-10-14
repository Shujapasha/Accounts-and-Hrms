<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payer extends Model
{
    protected $table = 'hrm_payers';
    protected $fillable = [
        'payer_name',
        'contact_number',
        'created_by',
    ];
   
}
