<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FamilyBackgroundResource extends JsonResource
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
            "attributes" => 
            [
                "spouse_surname" => (string)$this->spouse_surname,
                "spouse_first_name" => (string)$this->spouse_first_name,
                "spouse_middle_name" => (string)$this->spouse_middle_name,
                "name_extension" => (string)$this->name_extension,
                "occupation" => (string)$this->occupation,
                "employee_business_name" =>(string)$this->employee_business_name,
                "business_address" => (string)$this->business_address,
                "telephone_number" => (string)$this->telephone_number,
                "father_surname" => (string)$this->father_surname,
                "father_first_name" => (string)$this->father_first_name,
                "father_middle_name" => (string)$this->father_middle_name,
                "father_extension_name" => (string)$this->father_extension_name,
                "mother_maiden_surname" => (string)$this->mother_maiden_surname,
                "mother_first_name" => (string)$this->mother_first_name,
                "mother_maiden_middle_name" => (string)$this->mother_maiden_middle_name,
            ]
            ];
    }
}
