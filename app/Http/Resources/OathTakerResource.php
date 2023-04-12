<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OathTakerResource extends JsonResource
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
                "oathtaking_id" => (string)$this->oathtaking_id,
                "appointment_id" => (string)$this->appointment_id,
                "first_name" => (string)$this->first_name,
                "last_name" => (string)$this->last_name,
                "department" => (string)$this->department,
                "date_appointed" => (string)$this->date_appointed,                
            ]
                  
        ];
    }
}
