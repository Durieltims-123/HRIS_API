<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SalaryGrade;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function salaryGrade (): BelongsTo
    {
        return $this->belongsTo(SalaryGrade::class,'salary_grade_id');
    }
    public function qualificationStandards (): HasMany
    {
        return $this->hasMany(QualificationStandard::class);
    }
    public function hasManyLguPosition (): HasMany
    {
        return $this->hasMany(LguPosition::class);
    }

    protected $primaryKey = 'id';
    // protected $foreignKey = 'salary_grade_id';

    protected $fillable = [
        'code',
        'title',
        'salary_grade_id'
    ];
}
