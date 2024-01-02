<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    public function hasManyApplication()
    {
        return $this->hasMany(Application::class);
    }

    public function hasOnePersonnalDataSheet()
    {
        return $this->hasOne(PersonnalDataSheet::class);
    }

    public function hasManyServiceRecordForm()
    {
        return $this->hasMany(ServiceRecordForm::class);
    }

    public function hasManyEmployeeOrientation(): HasMany
    {
        return $this->hasMany(EmployeeOrientation::class, 'orientation_id');
    }
    public function belongsToDivision()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function belongsToLGUPosition()
    {
        return $this->belongsTo(LguPosition::class, 'lgu_position_id');
    }

    protected $fillable =
    [
        'division_id',
        'lgu_position_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix_name',
        'contact_number',
        'email_address',
        'current_position',
        'employee_status',
        'orientation_status',
    ];
}
