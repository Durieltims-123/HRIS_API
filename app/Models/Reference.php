<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;

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
