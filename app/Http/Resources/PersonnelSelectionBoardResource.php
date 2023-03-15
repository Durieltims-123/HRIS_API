<?php

namespace App\Http\Resources;

use App\Models\PsbMember;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonnelSelectionBoardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($this->member_name);
        return [
            "id" => (string)$this->id,
            "attributes"=>[
                "start_date" => (string)$this->start_date,
                "end_date" => (string)$this->end_date,
                "chairman" => (string)$this->chairman,
                "position" => (string)$this->position,
                "status" => (string)$this->status,
                'member_name' => $this->hasManyMembers->map(function ($member_name) {
                    return [
                        'employee_id' => $member_name->employee_id,
                        'member_name' => $member_name->member_name,
                        'member_position' => $member_name->member_position,
                    ];
                }),

            ],
            
           
        ];
    }
}
