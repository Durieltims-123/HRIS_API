<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interview extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function publicationInterview() : HasMany{
        return $this->hasMany(PublicationInterview::class,'interview_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
       'publication_id',
        'interview_date',
        'venue'
    ];
}
