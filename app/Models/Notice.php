<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    public function belongsToApplication(){
        return $this->belongsTo(Application::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'notice_type',
        'date_send',
        'date_received'
    ];
}
