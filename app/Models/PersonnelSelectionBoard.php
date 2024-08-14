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

    public function psbMembers(): HasMany
    {
        return $this->hasMany(PsbMember::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'date_of_effectivity',
        'end_of_effectivity',
        'presiding_officer',
        'presiding_officer_position'
    ];
}
