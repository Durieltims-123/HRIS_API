<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Office extends Model
{
    use HasFactory;

    public function belongsToPlantilla (): BelongsTo
    {
        return $this->belongsTo(Plantilla::class);
    }
    public function hasManyEmployee (): HasMany
    {
        return $this->hasMany(Employee::class);
    }
    public function belongsToDepartment():BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'department_id',
        'office_code',
        'office_name',
    ];
}
