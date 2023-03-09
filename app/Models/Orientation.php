<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orientation extends Model
{
    use HasFactory;
    
    public function hasManyEmployeeOrientation()
    {
        return $this->hasMany(EmployeeOrientation::class);
    }

    protected $fillable = 
    [
        'date_generated',
        'start_date',
        'end_date',
        'venue'
    ];
}
