<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    use HasFactory;

    public function belongsToPersonalDataSheet ():BelongsTo
    {
        return $this->belongsTo(PersonalDataSheet::class, 'personal_data_sheet_id');
    }
    public function belongsToQuestion ():BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'personal_data_sheet_id',
        'question_id',
        'choice',
        'details',
        'date_filed',
        'case_status'
    ];

}
