<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChildrenInformation extends Model
{
    use HasFactory;

    public function belongsToFamilyBackground ():BelongsTo
    {
        return $this->belongsTo(FamilyBackground::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        // 'pds_id',
        'family_background_id',
        'children_name',
        'children_birthdate'
    ];
}
