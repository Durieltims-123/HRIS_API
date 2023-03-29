<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barangay extends Model
{
    use HasFactory;

    public function belongsToMunicipality ():BelongsTo
    {
        return $this->belongsTo(Municipality::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'municipality_id',
        'barangay_name',
        'barangay_code',
    ];
}
