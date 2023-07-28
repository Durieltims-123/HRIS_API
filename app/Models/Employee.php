<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    public function hasOneApplication ()
    {
        return $this -> hasOne(Application::class);
    }
    
    public function hasOnePersonnalDataSheet()
    {
        return $this->hasOne(PersonnalDataSheet::class);
    }

    public function hasOneServiceRecordForm()
    {
        return $this->hasOne(ServiceRecordForm::class);
    }
    
    public function hasManyEmployeeOrientation() : HasMany{
        return $this->hasMany(EmployeeOrientation::class, 'orientation_id');
    }
     public function belongsToDivision()
     {
        return $this->belongsTo(Division::class, 'division_id');
     }

protected $fillable = 
    [
        'division_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix_name',
        'contact_number',
        'email_address',
        'current_position',
        'employment_status',
        'employee_status',
        'orientation_status',
    ];
}
