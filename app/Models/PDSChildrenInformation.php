<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PDSChildrenInformation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pds_children_information';
    protected $primaryKey = 'id';


    public function belongsToFamilyBackground(): BelongsTo
    {
        return $this->belongsTo(PDSFamilyBackground::class);
    }
    public function belongsToPersonalDataSheet(): BelongsTo
    {
        return $this->belongsTo(PersonalDataSheet::class);
    }



    protected $fillable = [
        'personal_data_sheet_id',
        'pds_family_background_id',
        'number',
        'name',
        'birthday'
    ];
}
