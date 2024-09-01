<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PDSAnswer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pds_answers';
    protected $primaryKey = 'id';

    public function belongsToPersonalDataSheet(): BelongsTo
    {
        return $this->belongsTo(PersonalDataSheet::class, 'personal_data_sheet_id');
    }
    public function belongsToQuestion(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    protected $fillable = [
        'personal_data_sheet_id',
        'question_id',
        'answer',
        'details',
        'deleted_at'
    ];
}
