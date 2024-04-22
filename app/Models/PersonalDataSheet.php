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

    // public function belongsToApplicant(): BelongsTo
    // {
    //     return $this->belongsTo(Applicant::class, 'applicant_id');
    // }
    // public function belongsToEmployee(): BelongsTo
    // {
    //     return $this->belongsTo(Employee::class, 'employee_id');
    // }

    public function personalInformation(): HasOne
    {
        return $this->hasOne(PersonalInformation::class);
    }

    public function familyBackGround(): HasOne
    {
        return $this->hasOne(FamilyBackground::class);
    }



    public function hasManyChildrenInformation(): HasMany
    {
        return $this->hasMany(ChildrenInformation::class);
    }
    public function hasManyEducationalBackground(): HasMany
    {
        return $this->hasMany(EducationalBackground::class);
    }
    public function hasManyCivilServiceEligibility(): HasMany
    {
        return $this->hasMany(CivilServiceEligibility::class);
    }
    public function hasManyWorkExperience(): HasMany
    {
        return $this->hasMany(WorkExperience::class);
    }
    public function hasManyVoluntaryWork(): HasMany
    {
        return $this->hasMany(VoluntaryWork::class);
    }
    public function hasManyTrainingProgramAttended(): HasMany
    {
        return $this->hasMany(TrainingProgramAttended::class);
    }
    public function hasManySpecialSkillHobby(): HasMany
    {
        return $this->hasMany(SpecialSkillHobby::class);
    }
    public function hasManyRecognition(): HasMany
    {
        return $this->hasMany(Recognition::class);
    }
    public function hasManyMembershipAssociation(): HasMany
    {
        return $this->hasMany(MembershipAssociation::class);
    }
    public function hasManyAnswer(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
    public function hasManyReference(): HasMany
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
