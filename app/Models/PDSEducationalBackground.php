<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PDSEducationalBackground extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pds_educational_backgrounds';
    protected $primaryKey = 'id';


    public function belongsToPersonalDataSheet(): BelongsTo
    {
        return $this->belongsTo(PersonalDataSheet::class, 'personal_data_sheet_id');
    }


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
