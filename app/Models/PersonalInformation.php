<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalInformation extends Model
{
    use HasFactory;
    USE  SoftDeletes;

    public function belongsToPersonalDataSheet(): BelongsTo
    {
        return $this->belongsTo(PersonalDataSheet::class, 'personal_data_sheet_id');
    }
    public function belongsToProvince(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'birth_place',
        'birth_date',
        'age',
        'sex',
        'height',
        'weight',
        'citizenship',
        'citizenship_type',
        'country',
        'blood_type',
        'civil_status',
        'tin',
        'gsis',
        'pagibig',
        'philhealth',
        'sss',
        'residential_province',
        'residential_municipality',
        'residential_barangay',
        'residential_house',
        'residential_subdivision',
        'residential_street',
        'residential_zipcode',
        'permanent_province',
        'permanent_municipality',
        'permanent_barangay',
        'permanent_house',
        'permanent_subdivision',
        'permanent_street',
        'permanent_zipcode',
        'telephone',
        'mobile_number',
        'email_address',
    ];
}
