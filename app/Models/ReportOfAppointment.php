<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportOfAppointment extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'reports'
    ];
}
