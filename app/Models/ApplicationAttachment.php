<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationAttachment extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function belongstoApplication(): BelongsTo
    {
        return $this->belongsTo(Application::class, 'application_id');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'application_id',
        'url'
    ];
}
