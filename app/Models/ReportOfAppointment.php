<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportOfAppointment extends Model
{
    use HasFactory;

    public function hasManyReportAppointment(){
        return $this->hasMany(ReportAppointment::class, 'roa_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'reports',
        'report_date'
    ];
}
