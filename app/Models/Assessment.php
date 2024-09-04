<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assessment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function belongsToApplication()
    {
        return $this->belongsTo(Application::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'application_id',
        'appropriate_eligibility',
        'training',
        'performance',
        'education',
        'experience',
        'psychosocial_attributes',
        'potential',
        'administrative',
        'technical',
        'leadership',
        'awards',
        'total_remarks',
        'additional_information',
        'remarks',
    ];
}
