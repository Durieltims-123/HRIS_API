<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'personal_data_sheet_id',
        'number',
        'questions',
        'choices',
    ];
}
