<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CivilServiceEligibilityResource extends JsonResource
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
                "career_service" => (string)$this->career_service,
                "rating" => (string)$this->rating,
                "examination_date" => (string)$this->examination_date,
                "place_examination" => (string)$this->place_examination,
                "license_number" => (string)$this->license_number,
                "date_validity" => (string)$this->date_validity,
                
            ]
            
        ];
    }
}
