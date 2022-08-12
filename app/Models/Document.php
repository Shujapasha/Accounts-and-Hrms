<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'hrm_documents';
    protected $fillable = [
        'name',
        'is_required',
        'created_by',
    ];
}
