<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRecordForm extends Model
{
    use HasFactory;

    public function hasOneEmployee()
    {
        return $this->hasOneEmployee(ServiceRecordForm::class);
    }

    protected $fillable = 
    [
        'date_from',
        'date_to',
        'appointment_records',
        'leave_without_pay',
        'remarks',
        'civil_status',
        'designation',
        'slary_annum',
        'office_department',
    ];
}
