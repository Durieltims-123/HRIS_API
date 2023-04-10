<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OathTaker extends Model
{
    use HasFactory;

    public function belongsToOathTaking() : BelongsTo{
        return $this->belongsTo(OathTaking::class, 'oathtaking_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'oathtaking_id',
        'appointment_id',
        'first_name',
        'last_name',
        'department',
        'job_title',
        'date_appointed'
    ];
}
