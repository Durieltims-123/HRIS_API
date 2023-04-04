<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DisqualificationResource extends JsonResource
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
                "application_id" => (string) $this->application_id,
                "date_disqualified" => (string)$this->date_disqualified,
                "reason" => (string)$this->reason,
                "application" => new ApplicationResource($this->whenLoaded('belongsToApplication'))
            ]
            
        ];
    }
}
