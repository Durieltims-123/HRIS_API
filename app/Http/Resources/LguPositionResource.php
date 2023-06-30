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
            "attributes"=>[
                "office_name" => (string)$this->lgu_position_id,
                "department_name" => (string)$this->department_name,
                "title" => (string)$this->title,
                "number" => (string)$this->number,
                "amount" => (string)$this->amount,
                "item_number" => (string)$this->item_number,
                "education" => (string)$this->education,
                "training" => (string)$this->training,
                "experience" => (string)$this->experience,
                "eligibility" => (string)$this->eligibility,
                "competency" => (string)$this->competency,
            ],
        ];
    }
}
