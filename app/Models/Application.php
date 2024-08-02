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

    public function notice(): HasOne
    {
        return $this->hasOne(Notice::class);
    }

    public function assessment(): HasOne
    {
        return $this->hasOne(Assessment::class);
    }
    public function disqualification(): HasOne
    {
        return $this->hasOne(Disqualification::class, 'application_id');
    }
    public function publication(): HasOne
    {
        return $this->hasOne(Publication::class);
    }
    public function individual()
    {
        return $this->morphTo();
    }

    public function attachments(): HasOne
    {
        return $this->hasOne(ApplicationAttachment::class);
    }

    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(Vacancy::class);
    }

    public function fullname()
    {
        if ($this->middle_name != "") {
            return $this->first_name . " " . $this->middle_name[0] . ". " . $this->last_name;
        } else {
            return $this->first_name . " " . $this->last_name;
        }
    }


    protected $primaryKey = 'id';

    protected $fillable = [
        'individual_type',
        'individual_id',
        'vacancy_id',
        'date_submitted',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'application_type',
        'status',
        'shortlisted',
        'interview',
        'appointed'
    ];
}
