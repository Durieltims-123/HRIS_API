<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceRecordForm extends Model
{
    use HasFactory;
    use SoftDeletes;
    

    public function belongsToEmployee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    protected $fillable = 
    [
        'employee_id',
        'date_from',
        'date_to',
        'appointment_records',
        'leave_without_pay',
        'remarks',
        'civil_status',
        'designation',
        'salary_annum',
        'division_office',
    ];
}
