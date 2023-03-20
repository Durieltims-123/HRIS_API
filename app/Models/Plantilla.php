<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Office;
use App\Models\Position;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Plantilla extends Model
{
    use HasFactory;

    public function hasOneOffice ():HasOne
    {
        return $this->hasOne(Office::class);
    }
    public function belongsToPosition ():BelongsTo
    {
        return $this->belongsTo(Position::class);
    }
    public function hasManyPositionDescription (): HasMany
    {
        return $this->hasMany(PositionDescription::class);
    }
    public function hasOneVacancy (): HasOne
    {
        return $this->hasOne(Vacancy::class);
    }

    protected $primaryKey = 'id';
    // protected $foreignKey = 'office_id';
    // protected $foreignKey = 'position_id';

    protected $fillable = [
        'office_id',
        'position_id',
        'place_of_assignment',
    ];
}
