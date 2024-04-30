<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notice extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function belongsToApplication(){
        return $this->belongsTo(Application::class, 'application_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'application_id',
        'notice_type',
        'date_sent',
        'date_received'
    ];
}
