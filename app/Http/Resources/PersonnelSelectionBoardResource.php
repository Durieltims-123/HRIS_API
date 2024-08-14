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
            "attributes" => [
                "date_of_effectivity" => (string)$this->date_of_effectivity,
                "end_of_effectivity" => (string)$this->end_of_effectivity,
                "presiding_officer" => (string)$this->presiding_officer,
                "presiding_officer_position" => (string)$this->presiding_officer_position,
                "members" => PsbMemberResource::collection($this->whenLoaded('psbMembers'))
            ],


        ];
    }
}
