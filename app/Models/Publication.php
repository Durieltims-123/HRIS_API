<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    public function hasManyPublicationInterview(){
        return $this->hasMany(Publication::class);
    }
    public function belongsToVacancy(){
        return $this->hasMany(Vacancy::class);
    }


    protected $primaryKey = 'id';

    protected $fillable = [
        'vacancy_id',
        'opening_date',
        'closing_date'
    ];
}
