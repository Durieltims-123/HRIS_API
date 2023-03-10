<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SalaryGrade extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'number',
        'amount',
    ];

}
