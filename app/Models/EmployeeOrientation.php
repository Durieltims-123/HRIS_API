<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeOrientation extends Model
{
    use HasFactory;
    
    public function hasManyEmployees()
        {
            return $this->hasMany(EmployeeOrientation::class);
        }
    public function hasManyOrientation()
        {
            return $this->hasMany(EmployeeOrientation::class);
        }

        protected $primaryKey = 'id';

        
    
}
