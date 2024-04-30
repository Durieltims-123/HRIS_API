<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PsbMember extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function hasManyAssessment():HasMany{
        return $this->hasMany(Assessment::class);
    }

    public function belongsToPSB():BelongsTo{
        return $this->belongsTo(PersonnelSelectionBoard::class);
    }

    public function belongsToManyInterview():BelongsToMany{
        return $this->belongsToMany(Interview::class);
    }

    protected $primaryKey = 'id';

    // protected $casts = [
    //     'employee_id'=> 'array',
    //     'member_name' => 'array',
    //     'member_position'=> 'array'
    // ];

    protected $fillable = [
        'personnel_selection_board_id',
        'employee_id',
        'member_name' ,
        'member_position'
    ];

    
}
