<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PositionResource extends JsonResource
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
            "attributes" => [

                //salary grade
                // "number" => (string)$this->belongsToSalaryGrade->number,
                // "amount" => (string)$this->belongsToSalaryGrade->amount,
                "title" => (string)$this->title,
                "number" => (string)$this->number,
                "amount" => (string)$this->amount,
                "education" => (string)$this->education,
                "training" => (string)$this->training,
                "experience" => (string)$this->experience,
                "eligibility" => (string)$this->eligibility,
                "competency" => (string)$this->competency,

                // 'salary_grade' => new SalaryGradeResource($this->whenLoaded('belongsToSalaryGrade')),

                //position
                

                // 'qualification_standards' => QualificationStandardResource::collection($this->whenLoaded('hasManyQualificationStandard') ),

                //qualification standards
                // "position_id" => (string)$this->hasManyQualificationStandard[0]->position_id,
                // "education" => (string)$this->hasManyQualificationStandard[0]->education,
                // "training" => (string)$this->hasManyQualificationStandard[0]->training,
                // "experience" => (string)$this->hasManyQualificationStandard[0]->experience,
                // "eligibility" => (string)$this->hasManyQualificationStandard[0]->eligibility,
                // "competency" => (string)$this->hasManyQualificationStandard[0]->competency,
            ],
            // "plantilla" => new VacancyResource($this->whenLoaded('hasManyPlantilla')),

        ];
    }
}
