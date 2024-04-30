<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryGrade extends Model{

    use HasFactory;
    use SoftDeletes;

    public function hasManyPosition (): HasMany
    {
        return $this->hasMany(Position::class, 'salary_grade_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'number',
        'amount',
    ];

}
