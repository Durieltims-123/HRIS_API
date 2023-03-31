<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PersonalInformation extends Model
{
    use HasFactory;

    public function belongsToPersonalDataSheet ():BelongsTo
    {
        return $this->belongsTo(PersonalDataSheet::class, 'personal_data_sheet_id');
    }
    public function belongsToProvince ():BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'personal_data_sheet_id',
        'mobile_number',
        'telephone_number',
        'permanent_house_number',
        'permanent_subdivision_village',
        'permanent_street',
        'barangay_id',
        'municipality_id',
        'province_id',

        'permanent_zip_code',
        'residential_house_number',
        'residential_subdivision_village',
        'residential_street',
        'r_barangay_id',
        'r_municipality_id',
        'r_province_id',

        'residential_zip_code',
        'citizenship',
        'agency_employee',
        'tin_number',
        'sss_number',
        'philhealth_number',
        'pag_ibig_number',
        'gsis_number',
        'blood_type',
        'weight',
        'height',
        'civil_status',
        'sex',
        'birthplace',
        'birthdate',
    ];
}
