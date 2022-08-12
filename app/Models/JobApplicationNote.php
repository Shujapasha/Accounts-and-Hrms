<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplicationNote extends Model
{
    protected $table = 'hrm_job_application_notes';
    protected $fillable = [
        'application_id',
        'note_created',
        'note',
        'created_by',
    ];

    public function noteCreated()
    {
        return $this->hasOne('App\Models\User', 'id', 'note_created');
    }
}
