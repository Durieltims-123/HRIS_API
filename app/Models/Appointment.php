<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    use HasFactory;

    public function belongsToApplication():BelongsTo{
        return $this->belongsTo(Application::class,'application_id');
    }
    public function belongsToReportOfAppointment():BelongsTo{
        return $this->belongsTo(ReportOfAppointment::class,'roa_id');
    }
    // public function hasManyOathTaker():HasMany{
    //     return $this->hasMany(OathTakers::class);
    // }

    protected $primaryKey = 'id';

    protected $fillable = [
        'application_id',
        'roa_id',
        'appointment_date',
        'reports'
    ];
}
