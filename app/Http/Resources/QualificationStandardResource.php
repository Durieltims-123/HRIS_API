<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QualificationStandardResource extends JsonResource
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
                "position_id" => (string)$this->position_id,
                "education" => (string)$this->education,
                "training" => (string)$this->training,
                "experience" => (string)$this->experience,
                "eligibility" => (string)$this->eligibility,
                "competency" => (string)$this->competency,
            ]
            
        ];
    }
}
