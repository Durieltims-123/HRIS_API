<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingProgramAttended extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'program_title',
        'hours',
        'type',
        'conducted_by',
        'inclusive_dates_from',
        'inclusive_dates_to'
    ];
}
