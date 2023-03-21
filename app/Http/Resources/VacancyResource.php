<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VacancyResource extends JsonResource
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
                "position_title" => (string)$this->position_title,
                "salary_grade" => (string)$this->salary_grade,
                "monthly_salary" => (string)$this->monthly_salary,

                "education" => (string)$this->education,
                "trainings" => (string)$this->trainings,
                "experience" => (string)$this->trainings,
                "eligibility" => (string)$this->eligibility,
                "competency" => (string)$this->competency,

                "plantilla_item_number" => (string)$this->plantilla_item_number,
                "office_name" => (string)$this->office_name,

                "date_submitted" => (string)$this->date_submitted,
                "date_queued" => (string)$this->date_queued,
                "date_approved" => (string)$this->date_approved,
                "status" => (string)$this->status,
            ]
            
        ];
    }
}
