<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    public function hasManyOffices(): HasMany
    {
        return $this->hasMany(Office::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'employee_code',
        'employee_name',
        'office_code',
        'office_name'
    ];
}
