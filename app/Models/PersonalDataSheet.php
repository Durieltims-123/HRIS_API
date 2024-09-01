<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalDataSheet extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function personalInformation(): HasOne
    {
        return $this->hasOne(PDSPersonalInformation::class);
    }

    public function familyBackGround(): HasOne
    {
        return $this->hasOne(PDSFamilyBackground::class);
    }

    public function childrenInformations(): HasMany
    {
        return $this->hasMany(PDSChildrenInformation::class);
    }

    public function educationalBackgrounds(): HasMany
    {
        return $this->hasMany(PDSEducationalBackground::class);
    }

    public function civilServiceEligibilities(): HasMany
    {
        return $this->hasMany(PDSCivilServiceEligibility::class);
    }

    public function workExperiences(): HasMany
    {
        return $this->hasMany(PDSWorkExperience::class);
    }

    public function voluntaryWorks(): HasMany
    {
        return $this->hasMany(PDSVoluntaryWork::class);
    }

    public function trainingPrograms(): HasMany
    {
        return $this->hasMany(PDSTrainingProgramAttended::class);
    }

    public function specialSkillHobies(): HasMany
    {
        return $this->hasMany(PDSSpecialSkillHobby::class);
    }

    public function recognitions(): HasMany
    {
        return $this->hasMany(PDSRecognition::class);
    }

    public function membershipAssociations(): HasMany
    {
        return $this->hasMany(PDSMembershipAssociation::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(PDSAnswer::class);
    }

    public function references(): HasMany
    {
        return $this->hasMany(PDSReference::class);
    }

    public function individual()
    {
        return $this->morphTo();
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'individual_id',
        'individual_type',
        'pds_date'
    ];

    // protected $fillable = [
    //     'applicant_id',
    //     'employee_id'
    // ];


}
