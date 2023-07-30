<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LguPositionResource extends JsonResource
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
                "division_name" => (string)$this->division_name,
                "office_name" => (string)$this->office_name,
                "division_id" => (string)$this->division_id,
                "position_id" => (string)$this->position_id,
                "year" => (string)$this->year,
                "division" => (string)$this->office_name . "-" . (string)$this->division_name,
                "title" => (string)$this->title,
                "number" => (string)$this->number,
                "amount" => (string)$this->amount,
                "item_number" => (string)$this->item_number,
                "education" => (string)$this->education,
                "training" => (string)$this->training,
                "experience" => (string)$this->experience,
                "eligibility" => (string)$this->eligibility,
                "competency" => (string)$this->competency,
                "status" => (string)$this->status,
                "description" => (string)$this->description,
                "place_of_assignment" => (string)$this->place_of_assignment,
                "position" => (string)$this->title ,
                "position_status" => (string)$this->position_status,
                "label" =>(string)$this->title." - ".(string)$this->item_number,
            ],
        ];
    }
}
