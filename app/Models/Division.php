<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Division extends Model
{
    use HasFactory;

    // public function belongsToLguPosition (): BelongsTo
    // {
    //     return $this->belongsTo(LguPosition::class);
    // }
    public function employee (): HasMany
    {
        return $this->hasMany(Employee::class);
    }
    public function office():BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'office_id',
        'division_code',
        'division_name',
    ];
}
