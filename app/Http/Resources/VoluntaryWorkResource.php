<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VoluntaryWorkResource extends JsonResource
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
                "organization_name" => (string)$this->organization_address,
                "organization_address" => (string)$this->organization_address,
                "position" => (string)$this->position,
                "number_hours" => (string)$this->number_hours,
                "inclusive_dates_from" => (string)$this->inclusive_dates_from,
                "inclusive_dates_to" => (string)$this->inclusive_dates_to,
            ]
        ];
    }
}
