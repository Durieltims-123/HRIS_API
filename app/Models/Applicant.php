<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Applicant extends Model
{
    use HasFactory;

    public function hasOneApplication()
    {
        return $this->hasOne(Application::class);
    }

    // public function hasOnePersonnalDataSheet()
    // {
    //     return $this->hasOne(PersonalDataSheet::class);
    // }


    public function personalDataSheets(): MorphMany
    {
        return $this->morphMany(PersonalDataSheet::class, 'individual_id');
    }

    public function latestPersonalDataSheet(): MorphOne
    {
        return $this->morphOne(PersonalDataSheet::class, 'individual_id')->latestOfMany();
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'suffix_name',
        'contact_number',
        'email_address',
    ];
}
