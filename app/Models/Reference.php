<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reference extends Model
{
    use HasFactory;

    public function belongsPersonalDataSheet ():BelongsTo
    {
        return $this->belongsTo(PersonalDataSheet::class, 'personal_data_sheet_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'personal_data_sheet_id',
        'name',
        'address',
        'telephone_number',
        'name2',
        'address2',
        'telephone_number2',
        'name3',
        'address3',
        'telephone_number3'
    ];
}
