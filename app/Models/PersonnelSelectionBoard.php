<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PersonnelSelectionBoard extends Model
{
    use HasFactory;

    public function psbMembers():HasMany
    {
        return $this->hasMany(PsbMember::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'start_date',
        'end_date',
        'chairman',
        'position',
        'status',
    ];
}
