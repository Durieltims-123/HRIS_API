<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssessmentResource extends JsonResource
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
                "application_id" => (string)$this->application_id,
                "member_id" => (string)$this->member_id,
                "training" => (string)$this->training,
                "performance" => (string)$this->performance,
                "education" => (string)$this->education,
                "experience" => (string)$this->experience,
                "psychosocial_attribute" => (string)$this->psychosocial_attribute,
                "potential" => (string)$this->potential,
                "awards" => (string)$this->awards,
                "additional_information" => (string)$this->additional_information,
                "remarks" => (string)$this->remarks,
                "date_of_assessment" => (string)$this->date_of_assessment,
                
            ]
            
        ];
    }
}
