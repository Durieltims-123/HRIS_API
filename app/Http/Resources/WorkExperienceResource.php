<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkExperienceResource extends JsonResource
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
                "position_title" => (string)$this->position_title,
                "department" => (string)$this->department,
                "monthly_salary" => (string)$this->monthly_salary,
                "salary" => (string)$this->salary,
                "status_appointment" => (string)$this->status_appointment,
                "government_service" => (string)$this->government_service,
                "inclusive_dates_from" => (string)$this->inclusive_dates_from,
                "inclusive_dates_to" => (string)$this->inclusive_dates_to,
            ]
        ];
    }
}
