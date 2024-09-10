<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function belongsToApplication(): BelongsTo
    {
        return $this->belongsTo(Application::class, 'application_id');
    }
    public function belongsToReportOfAppointment(): BelongsTo
    {
        return $this->belongsTo(ReportOfAppointment::class, 'roa_id');
    }

    public function appointee()
    {
        return $this->morphTo();
    }
    // public function hasManyOathTaker():HasMany{
    //     return $this->hasMany(OathTakers::class);
    // }

    protected $primaryKey = 'id';

    protected $fillable = [
        'nature_of_appointment',
        'vice',
        'vice_reason',
        'date_of_signing',
        'page_no',
        'date_received',
        'appointee_type',
        'appointee_id'

    ];
}
