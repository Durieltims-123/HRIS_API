<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function hasManyMunicipality ():HasMany 
    {
        return $this->hasMany(Municipality::class);
    }
    public function hasManyPersonalInformation ():HasMany
    {
        return $this->hasMany(PersonalInformation::class);
    }
            
    protected $primaryKey = 'id';

    protected $fillable = [
        'province_name',
        'province_code',
    ];
}
