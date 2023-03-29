<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    public function hasOneApplication()
    {
        return $this->hasOne(Application::class);
    }

    public function hasOnePersonnalDataSheet()
    {
        return $this->hasOne(PersonnalDataSheet::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'suffix_name',
        'contact_number',
        'email_address',
    ];
}
