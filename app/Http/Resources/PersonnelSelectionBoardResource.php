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
                "chairman" => (string)$this->chairman,
                "chairman_position" => (string)$this->chairman_position,
                "vice_chairman" => (string)$this->vice_chairman,
                "vice_chairman_position" => (string)$this->vice_chairman_position,
                "members" => PsbMemberResource::collection($this->whenLoaded('psbPersonnels'))
            ],


        ];
    }
}
