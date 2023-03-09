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
    // protected $foreignKey = 'plantilla_id';

    protected $fillable = [
        'date_submitted',
        'date_queued',
        'data_approved',
        'status',
    ];
}
