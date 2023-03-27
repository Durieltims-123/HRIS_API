<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlantillaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // $positionDescription = $this->whenLoaded('belongsToPlantilla');

        return [
            "id" => (string)$this->id,
            "attributes"=>[
                "office_id" => (string)$this->office_id,
                "position_id" => (string)$this->position_id,
                "item_number" => (string)$this->item_number,
                "place_of_assignment" => (string)$this->place_of_assignment,
                "year" => (string)$this->year,
            ],
            //  "vacancy" => new VacancyResource($this->whenLoaded('hasOneVacancy')),
            "vacancy" => new VacancyResource($this->whenLoaded('hasOneVacancy')),
            "position" => new PositionResource($this->whenLoaded('belongsToPosition')),
        ];
    }
}
