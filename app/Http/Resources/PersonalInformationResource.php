<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonalInformationResource extends JsonResource
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
                "mobile_number" => (string)$this->mobile_number,
                "telephone_number" => (string)$this->telephone_number,
                "permanent_house_number" => (string)$this->permanent_house_number,
                "permanent_subdivision_village" => (string)$this->permanent_subdivision_village,
                "permanent_street" => (string)$this->permanent_street,
                "permanent_zip_code_number" => (string)$this->permanent_zip_code_number,
                "residential_house_number" => (string)$this->residential_house_number,
                "residential_subdivision_village" => (string)$this->residential_subdivision_village,
                "residential_street" => (string)$this->residential_street,
                "residential_zip_code_number" => (string)$this->residential_zip_code_number,
                "citizenship" => (string)$this->citizenship,
                "agency_employee" => (string)$this->agency_employee,
                "tin_number" => (string)$this->tin_number,
                "sss_number" => (string)$this->sss_number,
                "philhealth_number" => (string)$this->philhealth_number,
                "pag_ibig_number" => (string)$this->pag_ibig_number,
                "gsis_number" => (string)$this->gsis_number,
                "blood_type" => (string)$this->blood_type,
                "weight" => (string)$this->weight,
                "height" => (string)$this->height,
                "civil_status" => (string)$this->civil_status,
                "sex" => (string)$this->sex,
                "birthplace" => (string)$this->birthplace,
                "birthdate" => (string)$this->birthdate,
            ]
            
        ];
    }
}
