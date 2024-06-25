<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Division;
use App\Models\Position;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class LguPosition extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id');
    }
    public function positionDescription(): HasMany
    {
        return $this->hasMany(PositionDescription::class, 'lgu_position_id');
    }
    public function vacancy(): HasMany
    {
        return $this->hasMany(Vacancy::class, 'lgu_position_id');
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
