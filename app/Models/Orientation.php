<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orientation extends Model
{
    use HasFactory;
    USE SoftDeletes;
    
    public function employeeOrientation() : HasMany{
        return $this->hasMany(EmployeeOrientation::class,'orientation_id');
    }
    
    // public function hasManyEmployeeOrientation()
    // {
    //     return $this->hasMany(EmployeeOrientation::class);
    // }

    protected $primaryKey = 'id';

    protected $fillable = 
    [
        'date_generated',
        'start_date',
        'end_date',
        'venue'
    ];
}
