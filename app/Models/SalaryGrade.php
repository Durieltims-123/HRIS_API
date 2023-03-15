<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SalaryGrade extends Model{
    use HasFactory;

    public function hasManyPosition ():HasMany
    {
        return $this->hasMany(Position::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'number',
        'amount',
    ];

}
