<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venue extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class);
    }

    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];



    protected $fillable = [
        'name',
    ];
}
