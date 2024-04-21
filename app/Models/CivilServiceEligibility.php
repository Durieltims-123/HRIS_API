<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CivilServiceEligibility extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public function belongsToPersonalDataSheet(): BelongsTo
    {
        return $this->belongsTo(PersonalDataSheet::class);
    }

    protected $fillable = [
        'personal_data_sheet_id',
        'eligibility_title',
        'rating',
        'date_of_examination_conferment',
        'place_of_examination_conferment',
        'license_number',
        'license_date_validity',
    ];
}
