<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepartmentHead extends Model
{
    use HasFactory;


    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'office_id',
        'prefix',
        'name',
        'position',
        'status',
    ];
}
