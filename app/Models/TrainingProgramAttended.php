<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingProgramAttended extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'personal_data_sheet_id',
        'program_title',
        'hours',
        'type',
        'conducted_by',
        'tp_inclusive_dates_from',
        'tp_inclusive_dates_to'
    ];
}
