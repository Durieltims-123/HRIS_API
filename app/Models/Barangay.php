<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barangay extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function belongsToMunicipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class, 'municipality_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'municipality_id',
        'barangay_name',
        'barangay_code',
    ];
}
