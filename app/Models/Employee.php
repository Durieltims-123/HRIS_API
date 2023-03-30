<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    
    public function hasManyEmployeeOrientation()
     {
        return $this->hasMany(EmployeeOrientation::class);
     }
     public function belongsToOffice()
     {
        return $this->belongsTo(Office::class, 'office_id');
     }

protected $fillable = 
    [
        'office_id',
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
