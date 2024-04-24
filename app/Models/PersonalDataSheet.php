<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PersonalDataSheet extends Model
{
    use HasFactory;

    public function personalInformation(): HasOne
    {
        return $this->hasOne(PersonalInformation::class);
    }

    public function familyBackGround(): HasOne
    {
        return $this->hasOne(FamilyBackground::class);
    }

    public function childrenInformations(): HasMany
    {
        return $this->hasMany(ChildrenInformation::class);
    }

    public function educationalBackgrounds(): HasMany
    {
        return $this->hasMany(EducationalBackground::class);
    }

    public function civilServiceEligibilities(): HasMany
    {
        return $this->hasMany(CivilServiceEligibility::class);
    }

    public function workExperiences(): HasMany
    {
        return $this->hasMany(WorkExperience::class);
    }

    public function voluntaryWorks(): HasMany
    {
        return $this->hasMany(VoluntaryWork::class);
    }

    public function trainingPrograms(): HasMany
    {
        return $this->hasMany(TrainingProgramAttended::class);
    }

    public function specialSkillHobies(): HasMany
    {
        return $this->hasMany(SpecialSkillHobby::class);
    }

    public function recognitions(): HasMany
    {
        return $this->hasMany(Recognition::class);
    }

    public function membershipAssociations(): HasMany
    {
        return $this->hasMany(MembershipAssociation::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
    
    public function references(): HasMany
    {
        return $this->hasMany(Reference::class);
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
