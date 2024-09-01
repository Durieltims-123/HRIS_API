<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PDSVoluntaryWork extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pds_voluntary_works';
    protected $primaryKey = 'id';


    public function belongsToPersonalDataSheet(): BelongsTo
    {
        return $this->belongsTo(PersonalDataSheet::class, 'personal_data_sheet_id');
    }

    protected $fillable = [
        'personal_data_sheet_id',
        'organization_name',
        'organization_address',
        'date_from',
        'date_to',
        'number_of_hours',
        'position_nature_of_work',
    ];
}
