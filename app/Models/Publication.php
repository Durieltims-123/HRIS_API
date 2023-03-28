<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Publication extends Model
{
    use HasFactory;

    public function hasManyPublicationInterview() : HasMany{
        return $this->hasMany(Publication::class);
    }
    public function belongsToVacancy() : BelongsTo{
        return $this->belongsTo(Vacancy::class, 'vacancy_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'vacancy_id',
        'opening_date',
        'closing_date'
    ];
}
