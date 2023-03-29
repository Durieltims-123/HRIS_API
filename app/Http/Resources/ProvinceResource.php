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
            "attributes" => [
                "province_name" => (string)$this->province_name,
                "province_code" => (string)$this->province_code,

                //municipality
                // "province_id" => (string)$this->hasOneMunicipality[0]->province_id,
                "municipality_name" => (string)$this->hasManyBarangay[0]->municipality_name,
                "municipality_code" => (string)$this->hasManyBarangay[0]->municipality_code,

                //barangay
                "barangay_name" => (string)$this->belongsToMunicipality[0]->barangay_name,
                "barangay_code" => (string)$this->belongsToMunicipality[0]->barangay_code,
            ]

        ];
    }
}
