<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDocument extends Model
{
    protected $table = 'hrm_employee_documents';
    protected $fillable = [
        'employee_id','document_id','document_value','created_by'
    ];
}
