<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportAppointment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function belongsToReportOfAppointment():BelongsTo
    {
        return $this->belongsTo(ReportOfAppointment::class);
    }

    protected $fillable =[
        "roa_id",
        "appointment_id"
    ];
}
