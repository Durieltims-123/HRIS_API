<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OathTaking extends Model
{
    use HasFactory;

    public function hasManyOathTakers(): HasMany
    {
        return $this->hasMany(OathTaker::class, 'oathtaking_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        "venue",
        "oath_date",
        "date_generated",
        
    ];
}

