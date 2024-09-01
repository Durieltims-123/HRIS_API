<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PDSReference extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pds_references';
    protected $primaryKey = 'id';


    public function belongsToPersonalDataSheet(): BelongsTo
    {
        return $this->belongsTo(PersonalDataSheet::class, 'personal_data_sheet_id');
    }


    protected $fillable = [
        'personal_data_sheet_id',
        'name',
        'address',
        'number'
    ];
}
