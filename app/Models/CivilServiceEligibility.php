<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CivilServiceEligibility extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'personal_data_sheet_id',
        'career_service',
        'rating',
        'examination_date',
        'place_examination',
        'license_number',
        'date_validity'
    ];
}
