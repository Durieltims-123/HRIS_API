<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interview extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function vacancyInterview(): HasMany
    {
        return $this->hasMany(VacancyInterview::class, 'interview_id');
    }

       public function venue(): BelongsTo
    {
        return $this->BelongsTo(Venue::class, '');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'interview_date',
        'venue'
    ];
}
