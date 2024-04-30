<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recognition extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function belongsToPersonalDataSheet(): BelongsTo
    {
        return $this->belongsTo(PersonalDataSheet::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'personal_data_sheet_id',
        'recognition_title',
    ];
}
