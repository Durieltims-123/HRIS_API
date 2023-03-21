<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Vacancy extends Model
{
    use HasFactory;
    public function belongsToPlantilla (): BelongsTo
    {
        return $this->belongsTo(Plantilla::class);
    }
    public function hasManyPublication (): HasMany
    {
        return $this->hasMany(Publication::class);
    }

    protected $primaryKey = 'id';
    

    protected $fillable = [
        'plantilla_id',
        
        'position_title',
        'job_description',
        'plantilla_item_number',
        'status',
        'date_submitted',
        'office_code',
        'office_name',
        'date_queued',
        'date_approved',
        'place_of_assignment',
        'department_code',
        'department_name'
    ];
}
