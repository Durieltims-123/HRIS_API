<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PDSRecognition extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pds_recognitions';
    protected $primaryKey = 'id';


    public function belongsToPersonalDataSheet(): BelongsTo
    {
        return $this->belongsTo(PersonalDataSheet::class);
    }


    protected $fillable = [
        'personal_data_sheet_id',
        'recognition_title',
    ];
}
