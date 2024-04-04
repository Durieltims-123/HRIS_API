<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    public function application()
    {
        return $this->hasMany(Application::class);
    }

    public function personalDataSheet()
    {
        return $this->hasOne(PersonalDataSheet::class);
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
