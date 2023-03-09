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
        return $this->belongsTo(PersonalDataSheet::class);
    }
    public function hasOneProvince ():HasOne
    {
        return $this->hasOne(Province::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'mobile_number',
        'telephone_number',
        'permanent_house_number',
        'permanent_subdivision_village',
        'permanent_street',
        
        'permanent_zip_code_number',
        'residential_house_number',
        'residential_subdivision_village',
        'residential_street',
        'residential_zip_code_number',
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
