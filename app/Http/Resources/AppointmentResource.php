<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
                "application_id" => (string)$this->application_id,
                "report_of_appointment_id" =>  (string)$this->roa_id,
                "application" => new ApplicationResource($this->whenLoaded('belongsToApplication')),
            ]
        ];
    }
}
