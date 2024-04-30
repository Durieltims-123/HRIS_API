<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EducationalBackground extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function belongsToPersonalDataSheet(): BelongsTo
    {
        return $this->belongsTo(PersonalDataSheet::class, 'personal_data_sheet_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'level',
        'school_name',
        'degree',
        'period_to',
        'period_from',
        'highest_unit_earned',
        'year_graduated',
        'scholarship_academic_awards',
    ];
}
