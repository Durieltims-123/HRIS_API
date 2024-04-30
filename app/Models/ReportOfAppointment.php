<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportOfAppointment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function hasManyReportAppointment(){
        return $this->hasMany(ReportAppointment::class, 'roa_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'reports',
        'report_date'
    ];
}
