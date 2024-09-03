<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacancy extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function lguPosition(): BelongsTo
    {
        return $this->belongsTo(LguPosition::class, 'lgu_position_id');
    }
    public function hasManyPublication(): HasMany
    {
        return $this->hasMany(Publication::class, 'vacancy_id');
    }

    public function hasManyApplications(): HasMany
    {
        return $this->hasMany(Application::class, 'vacancy_id');
    }

    public function vacancyInterview(): HasOne
    {
        return $this->hasOne(VacancyInterview::class, 'vacancy_id');
    }

    // public function latestVacancyInterview(): HasMany
    // {
    //     return $this->hasMany(VacancyInterview::class, 'vacancy_id');
    // }

    protected $primaryKey = 'id';


    protected $fillable = [
        'date_submitted',
        'date_queued',
        'date_approved',
        'status',
        'lgu_position_id',
        'division_id',
        'position_id',
        'item_number',
        'place_of_assignment',
        'year'
    ];
}
