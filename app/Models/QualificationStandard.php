<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class QualificationStandard extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function belongsPosition(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'position_id',
        'education',
        'training',
        'experience',
        'eligibility',
        'competency',
    ];
}
