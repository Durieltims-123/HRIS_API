<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoluntaryWork extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'organization_name',
        'organization_address',
        'position',
        'number_hours',
        'inclusive_dates_from',
        'inclusive_dates_to'
    ];
}
