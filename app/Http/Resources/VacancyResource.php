<?php

namespace App\Http\Resources;

use App\Models\Plantilla;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VacancyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $plantilla = $this->whenLoaded('belongsToPlantilla');

        return [
            "id" => (string)$this->id,
            "attributes"=>[
                "date_submitted" => (string)$this->date_submitted,
                "date_queued" => (string)$this->date_queued,
                "date_approved" => (string)$this->date_approved,
                "status" => (string)$this->status,

                // "item_number" => (string)$this->belongsToPlantilla->item_number,
                
            ],
            "plantilla" => new PlantillaResource($plantilla),

            
        ];
    }
}
