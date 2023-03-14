<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SalaryGrade extends s
    use HasFactory;

<<<<<<< Updated upstream
=======
    public function hasManyPosition ():HasMany
    {
        return $this->hasMany(Position::class);
    }

    protected $primaryKey = 'id';
>>>>>>> Stashed changes

    protected $fillable = [
        'number',
        'amount',
    ];

}
