<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainingProgramAttended extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'training_programs_attended';

    public function belongsToPersonalDataSheet(): BelongsTo
    {
        return $this->belongsTo(PersonalDataSheet::class, 'personal_data_sheet_id');
    }

    protected $fillable = [
        'personal_data_sheet_id',
        'training_title',
        'attendance_from',
        'attendance_to',
        'number_of_hours',
        'training_type',
        'conducted_sponsored_by'
    ];
}
