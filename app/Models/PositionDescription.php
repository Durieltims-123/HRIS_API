<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PositionDescription extends Model
{
    use HasFactory;

    public function lguPosition (): BelongsTo
    {
        return $this->belongsTo(LguPosition::class, 'lgu_position_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'lgu_position_id',
        'description',
    ];
}
