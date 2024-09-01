<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PDSSpecialSkillHobby extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'pds_special_skill_hobbies';
    protected $primaryKey = 'id';


    public function belongsToPersonalDataSheet(): BelongsTo
    {
        return $this->belongsTo(PersonalDataSheet::class, 'personal_data_sheet_id');
    }



    protected $fillable = [
        'personal_data_sheet_id',
        'special_skill'
    ];
}
