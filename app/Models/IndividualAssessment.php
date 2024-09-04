<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndividualAssessment extends Model
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
        'ia_psychosocial_attributes',
        'ia_potential',
        'ia_awards',
        'ia_total',
    ];
}
