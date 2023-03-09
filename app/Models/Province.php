<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Province extends Model
{
    use HasFactory;

    public function hasOneMunicipality ():HasOne
    {
        return $this->hasOne(Municipality::class);
    }
    public function belongsToPersonalInformation ():BelongsTo
    {
        return $this->belongsTo(PersonalInformation::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'permanent_province_name',
        'residential_province_name',
    ];
}
