<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function hasOneNotice(): HasOne
    {
        return $this->hasOne(Notice::class);
    }
    public function hasOneDisqualification(): HasOne
    {
        return $this->hasOne(Disqualification::class, 'application_id');
    }
    public function hasOnePublication(): HasOne
    {
        return $this->hasOne(Publication::class);
    }
    public function belongsToApplicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }
    public function belongsToEmployee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'applicant_id',
        'employee_id',
        'publication_id',
        'submission_date',
        'first_name',
        'middle_name',
        'last_name',
        'suffix_name',
        'application_type',
        'status'
    ];
}
