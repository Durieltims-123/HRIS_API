<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Division;
use App\Models\Position;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LguPosition extends Model
{
    use HasFactory;

    public function hasOneDivision(): HasOne
    {
        return $this->hasOne(Division::class);
    }
    public function belongsToPosition(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id');
    }
    public function hasManyPositionDescription(): HasMany
    {
        return $this->hasMany(PositionDescription::class, 'lgu_position_id');
    }
    public function hasOneVacancy(): HasOne
    {
        return $this->hasOne(Vacancy::class, 'lgu_position_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'division_id',
        'position_id',
        'item_number',
        'place_of_assignment',
        'year',
        'position_status',
        'status'

    ];
}
