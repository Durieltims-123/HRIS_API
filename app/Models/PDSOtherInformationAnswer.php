<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PDSOtherInformationAnswer extends Model
{
    use HasFactory;
    USE SoftDeletes;

    protected $table = 'pds_other_information';
    protected $primaryKey = 'id';


    protected $fillable = [
        'personal_data_sheet_id',
        'answer',
        'remarks'
    ];
}
