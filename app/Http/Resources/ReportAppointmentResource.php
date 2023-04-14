<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportAppointmentResource extends JsonResource
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
                "roa_id" => (string)$this->roa_id,
                "application_id" => (string)$this->application_id,
            ]
            
        ];
    }
}
