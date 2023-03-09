<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'position_title',
        'department',
        'monthly_salary',
        'salary',
        'status_appointment',
        'government_service',
        'inclusive_dates_from',
        'inclusive_dates_to'
    ];
}
