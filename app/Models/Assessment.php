<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    public function belongsToPsbMember(){
        return $this->belongsTo(PsbMember::class);
    }
    public function belongsToApplication(){
        return $this->belongsTo(Application::class);
    }

    protected $primaryKey = 'id';

    protected $fillable =[
        'psychological_attribute',
        'potential',
        'awards',
        'additional_information',
        'remarks',
        'date_of_assessment'
    ];
}
