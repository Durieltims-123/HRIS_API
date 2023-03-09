<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalBackground extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'level',
        'school_name',
        'basic_education',
        'scholarship_honor',
        'highest_level',
        'year_graduated',
        'inclusive_dates_from',
        'inclusive_dates_to'
    ];
}
