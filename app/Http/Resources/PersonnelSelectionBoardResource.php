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
                "member_name" => (string)$this->hasManyMembers[0]->member_name,
                "member_name" => (string)$this->hasManyMembers[1]->member_name,
                // 'member_name' => PsbMemberResource::collection($this->member_name),
                // "member_name" => (string)$this->member_name,
                // "member_name" => PsbMemberResource::collection($this->member_name),
            ],
            
           
        ];
    }
}
