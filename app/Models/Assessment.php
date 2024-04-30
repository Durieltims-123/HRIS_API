<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assessment extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function belongsToPsbMember()
    {
        return $this->belongsTo(PsbMember::class);
    }
    public function belongsToApplication()
    {
        return $this->belongsTo(Application::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'application_id',
        'member_id',
        'training',
        'performance',
        'education',
        'experience',
        'psychological_attribute',
        'potential',
        'awards',
        'additional_information',
        'remarks',
        'date_of_assessment'
    ];
}
