<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PositionDescription extends Model
{
    use HasFactory;

    public function hasOnePlantilla (): HasOne
    {
        return $this->hasOne(Plantilla::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'plantilla_id',
        'description',
    ];
}
