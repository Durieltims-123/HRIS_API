<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applicant extends Model
{
    public function application()
    {
        return $this->morphMany(Application::class, 'individual');
    }

    public function personalDataSheets(): MorphMany
    {
        return $this->morphMany(PersonalDataSheet::class, 'individual');
    }

    public function latestPersonalDataSheet(): MorphOne
    {
        return $this->morphOne(PersonalDataSheet::class, 'individual')->latestOfMany()->take(1);
    }

    public function serviceRecordForm()
    {
        return $this->hasMany(ServiceRecordForm::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'mobile_number',
        'email_address',
    ];
}
