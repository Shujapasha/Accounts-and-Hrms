<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AwardType extends Model
{
    protected $table = 'hrm_award_types';
    protected $fillable = [
        'name',
        'created_by',
    ];
}
