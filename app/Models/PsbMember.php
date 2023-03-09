<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PsbMember extends Model
{
    use HasFactory;

    public function hasManyAssessment():HasMany{
        return $this->hasMany(Assessment::class);
    }

    public function belongsToPSB():BelongsTo{
        return $this->belongsTo(PersonnelSelectionBoard::class);
    }

    public function belongsToManyInterview():BelongsToMany{
        return $this->belongsToMany(Interview::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'member_name',
        'member_position'
    ];
}
