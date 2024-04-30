<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Municipality extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function hasManyBarangay ():HasMany
    {
        return $this->hasMany(Barangay::class);
    }
    public function belongsToProvince ():BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'province_id',
        'municipality_name',
        'municipality_code',
    ];
}
