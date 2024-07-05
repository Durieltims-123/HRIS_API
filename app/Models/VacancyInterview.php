<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VacancyInterview extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function belongsToPublication() : BelongsTo{
        return $this->belongsTo(Publication::class,'publication_id');
    }
    public function belongsToInterview() : BelongsTo{
        return $this->belongsTo(Interview::class,'interview_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'publication_id',
        'interview_id'
    ];
}
