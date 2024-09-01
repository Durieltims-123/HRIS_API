<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PDSFamilyBackground extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pds_family_backgrounds';
    protected $primaryKey = 'id';


    public function belongsToPersonalDataSheet(): BelongsTo
    {
        return $this->belongsTo(PersonalDataSheet::class, 'personal_data_sheet_id');
    }

    public function hasManyChildrenInformation(): HasMany
    {
        return $this->hasMany(PDSChildrenInformation::class);
    }


    protected $fillable = [
        'personal_data_sheet_id',
        'spouse_first_name',
        'spouse_middle_name',
        'spouse_last_name',
        'spouse_suffix',
        'spouse_occupation',
        'spouse_employer',
        'spouse_employer_address',
        'spouse_employer_telephone',
        'father_first_name',
        'father_middle_name',
        'father_last_name',
        'father_suffix',
        'mother_first_name',
        'mother_middle_name',
        'mother_last_name',
        'mother_suffix',
    ];
}
