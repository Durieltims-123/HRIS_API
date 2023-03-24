<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    public function hasManyOffices():HasMany
    {
        return $this->hasMany(Office::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'department_code',
        'department_name',
        'office_code',
        'office_name'
    ];
}
