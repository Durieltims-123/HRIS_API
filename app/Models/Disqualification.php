<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disqualification extends Model
{
    use HasFactory;

    public function belongsToApplication(){
        return $this->belongsTo(Application::class, 'application_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'application_id',
        'date_disqualified',
        'reason',

        'member_id',
        'training',
        'performance',
        'education',
        'experience',
    ];
}
