<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PositionDescription extends Model
{
    use HasFactory;

    public function belongsToPlantilla (): BelongsTo
    {
        return $this->belongsTo(Plantilla::class, 'plantilla_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'plantilla_id',
        'description',
    ];
}
