<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BarangayResource extends JsonResource
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
                "permanent_barangay_name" => (string)$this->permanent_barangay_name,
                "residential_barangay_name" => (string)$this->residential_barangay_name,
            ]
            
        ];
    }
}
