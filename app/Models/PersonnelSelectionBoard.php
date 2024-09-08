<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonnelSelectionBoard extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function psbPersonnels(): HasMany
    {
        return $this->hasMany(PsbPersonnel::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'date_of_effectivity',
        'end_of_effectivity',
        'chairman_prefix',
        'chairman',
        'chairman_position',
        'chairman_office',
        'vice_chairman_prefix',
        'vice_chairman',
        'vice_chairman_position',
        'vice_chairman_office',
    ];
}
