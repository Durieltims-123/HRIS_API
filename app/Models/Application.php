<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Application extends Model
{
    use HasFactory;

    public function hasManyNotice():HasMany{
        return $this->hasMany(Notice::class);
    }
    public function belongsToDisqualification():BelongsTo{
        return $this->belongsTo(Disqualification::class);
    }
    public function hasOnePublication():HasOne{
        return $this->hasOne(Publication::class);
    }
    public function belongsToApplicant():BelongsTo{
        return $this->belongsTo(Applicant::class);
    }
    public function belongsToEmployee():BelongsTo{
        return $this->belongsTo(Employee::class);
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'submission_date',
        'first_name',
        'middle_name',
        'last_name',
        'suffix_name',
        'application_type',
        'status',
    ];
}
