<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use HasFactory;
    use SoftDeletes;

    // public function lguPosition (): BelongsTo
    // {
    //     return $this->belongsTo(LguPosition::class);
    // }
    public function employee(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'office_id',
        'division_code',
        'division_name',
        'division_type',
    ];
}
