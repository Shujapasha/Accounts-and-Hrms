<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    protected $table = 'hrm_job_categories';
    protected $fillable = [
        'title',
        'created_by',
    ];
}
