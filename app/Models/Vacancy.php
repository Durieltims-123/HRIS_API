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
        return $this->belongsTo(Plantilla::class, 'plantilla_id');
    }
    public function hasManyPublication (): HasMany
    {
        return $this->hasMany(Publication::class, 'vacancy_id');
    }

    protected $primaryKey = 'id';
    

    protected $fillable = [

        'date_submitted',
        'date_queued',
        'date_approved',
        'status',
        'plantilla_id',

        'office_id',
        'position_id',
        'item_number',
        'place_of_assignment',
        'year'
    ];
}
