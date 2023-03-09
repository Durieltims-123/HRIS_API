<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyBackground extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'spouse_surname',
        'spouse_first_name',
        'spouse_middle_name',
        'name_extension',
        'occupation',
        'employee_business_name',
        'business_address',
        'telephone_number',
        'father_surname',
        'father_first_name',
        'father_middle_name',
        'father_extension_name',
        'mother_maiden_surname',
        'mother_first_name',
        'mother_maiden_middle_name'
    ];
}
