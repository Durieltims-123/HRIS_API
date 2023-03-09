<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QualificationStandard extends Model
{
    use HasFactory;


    //  public function belongsPosition (): BelongsTo
    //  {
    //      return $this->belongsTo(Position::class);
    //  }

    protected $primaryKey = 'id';

    protected $fillable = [
        'education',
        'training',
        'experience', 
        'eligibility',
        'competency',
    ];

}
