<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MinicipalityResource extends JsonResource
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
                "permanent_municipality_name" => (string)$this->permanent_municipality_name,
                "residential_municipality_name" => (string)$this->residential_municipality_name,
            ]
            
        ];
    }
}
