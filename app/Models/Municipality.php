<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Municipality extends Model
{
    use HasFactory;

    public function hasOneBarangay ():HasOne
    {
        return $this->hasOne(Barangay::class);
    }
    public function belongsToProvince ():BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        // 'province_id',
        'permanent_municipality_name',
        'residential_municipality_name',
    ];
}
