<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicationResource extends JsonResource
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
                "vacancy_id" => (string)$this->vacancy_id,
                "posting_date" => (string)$this->posting_date,
                "closing_date" => (string)$this->closing_date,
                "vacancy" => new VacancyResource($this->whenLoaded('belongsToVacancy')),
                "application" => new ApplicationResource($this->whenLoaded('hasOneApplication'))
            ]
        ];
    }
}
