<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkExperience extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public function belongsToPersonalDataSheet(): BelongsTo
    {
        return $this->belongsTo(PersonalDataSheet::class, 'personal_data_sheet_id');
    }

    protected $fillable = [
        'personal_data_sheet_id',
        'position_title',
        'office_company',
        'monthly_salary',
        'salary_grade',
        'status_of_appointment',
        'government_service',
        'date_from',
        'date_to',
    ];
}
