<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    protected $table = 'hrm_ticket_replies';
    protected $fillable = [
        'employee_id',
        'description',
        'created_by',
    ];
}
