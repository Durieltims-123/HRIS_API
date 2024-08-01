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

    public function vacancy() : BelongsTo{
        return $this->belongsTo(Vacancy::class,'vacancy_id');
    }
    public function interview() : BelongsTo{
        return $this->belongsTo(Interview::class,'interview_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'vacancy_id',
        'interview_id'
    ];
}
