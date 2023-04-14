<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeOrientation extends Model
{
    use HasFactory;

    public function belongsToEmployee() : BelongsTo{
        return $this->belongsTo(Employee::class,'employee_id');
    }
    public function belongsToOrientation() : BelongsTo{
        return $this->belongsTo(Orientation::class,'orientation_id');
    }

        protected $primaryKey = 'id';

        protected $fillable = [
            'employee_id',
            'orientation_id'
        ];
        
    
}
