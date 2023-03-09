<?php

namespace App\Http\Resources;

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
        return [
            "id" => (string)$this->id,
            "attributes"=>[
                "start_date" => (string)$this->start_date,
                "end_date" => (string)$this->end_date,
                "chairman" => (string)$this->chairman,
                "position" => (string)$this->position,
                "status" => (string)$this->status,
                
            ]
            
        ];
    }
}
