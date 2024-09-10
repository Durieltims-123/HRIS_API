<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function application()
    {
        return $this->morphMany(Application::class, 'individual');
    }

    public function appointment()
    {
        return $this->morphMany(Appointment::class, 'appointee');
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

    public function employeeOrientation(): HasMany
    {
        return $this->hasMany(EmployeeOrientation::class, 'orientation_id');
    }
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function lguPosition()
    {
        return $this->belongsTo(LguPosition::class, 'lgu_position_id');
    }

    protected $fillable =
    [
        'division_id',
        'employee_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'mobile_number',
        'email_address',
        'lgu_position_id',
        'employment_status',
        'employee_status',
        'orientation_status',
    ];
}
