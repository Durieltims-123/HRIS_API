<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProvinceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            //province
            "id" => (string)$this->id,
            "attributes"=>[
                "permanent_province_name" => (string)$this->permanent_province_name,
                "residential_province_name" => (string)$this->residential_province_name,

            //municipality
                // "province_id" => (string)$this->hasOneMunicipality[0]->province_id,
                "permanent_municipality_name" => (string)$this->hasOneMunicipality[0]->permanent_municipality_name,
                "residential_municipality_name" => (string)$this->hasOneMunicipality[0]->residential_municipality_name,

            //barangay

            ]
            
        ];
    }
}
