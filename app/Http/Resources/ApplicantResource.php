<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return 
        [
            "id" => (string)$this->id,
            "attributes" => 
            [
                "first_name" => (string)$this->first_name,
                "middle_name" => (string)$this->middle_name,
                "last_name" => (string)$this->last_name,
                "suffix_name" => (string)$this->suffix_name,
                "contact_number" => (string)$this->contact_number,
                "email_address" =>(string)$this->email_address,
            ]
        ];
    }
}
