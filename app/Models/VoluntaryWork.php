<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoluntaryWork extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'personal_data_sheet_id',
        'organization_name',
        'organization_address',
        'position',
        'number_hours',
        'vw_inclusive_dates_from',
        'vw_inclusive_dates_to'
    ];
}
