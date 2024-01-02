<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Publication extends Model
{
    use HasFactory;

    public function hasManyPublicationInterview() : HasMany{
        return $this->hasMany(PublicationInterview::class, 'interview_id');
    }
    public function belongsToVacancy() : BelongsTo{
        return $this->belongsTo(Vacancy::class, 'vacancy_id');
    }
    public function hasOneApplication() : HasOne{
        return $this->hasOne(Application::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'vacancy_id',
        'posting_date',
        'closing_date'
    ];
}
