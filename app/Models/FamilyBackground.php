<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FamilyBackground extends Model
{
    use HasFactory;
    public function belongsToPersonalDataSheet ():BelongsTo
    {
        return $this->belongsTo(PersonalDataSheet::class);
    }

    public function hasManyChildrenInformation (): HasMany
    {
        return $this->hasMany(ChildrenInformation::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'personal_data_sheet_id',
        'spouse_surname',
        'spouse_first_name',
        'spouse_middle_name',
        'name_extension',
        'occupation',
        'employee_business_name',
        'business_address',
        'telephone_number',
        'father_surname',
        'father_first_name',
        'father_middle_name',
        'father_extension_name',
        'mother_maiden_surname',
        'mother_first_name',
        'mother_maiden_middle_name'
    ];
}
