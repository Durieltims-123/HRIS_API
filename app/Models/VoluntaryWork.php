<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VoluntaryWork extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public function belongsToPersonalDataSheet(): BelongsTo
    {
        return $this->belongsTo(PersonalDataSheet::class, 'personal_data_sheet_id');
    }

    protected $fillable = [
        'personal_data_sheet_id',
        'organization_name',
        'organization_address',
        'date_from',
        'date_to',
        'number_of_hours',
        'position_nature_of_work',
    ];
}
