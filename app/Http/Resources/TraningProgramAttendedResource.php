<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TraningProgramAttendedResource extends JsonResource
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
                "program_title" => (string)$this->program_title,
                "hours" => (string)$this->hours,
                "type" => (string)$this->type,
                "conducted_by" => (string)$this->conducted_by,
                "inclusive_dates_from" => (string)$this->inclusive_dates_from,
                "inclusive_dates_to" => (string)$this->inclusive_dates_to,
            ]
        ];
    }
}
