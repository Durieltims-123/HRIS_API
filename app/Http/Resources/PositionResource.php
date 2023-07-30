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
            "label" => (string)$this->title,
            "attributes" => [
                "title" => (string)$this->title,
                "number" => (string)$this->number,
                "amount" => (string)$this->amount,
                "education" => (string)$this->education,
                "training" => (string)$this->training,
                "experience" => (string)$this->experience,
                "eligibility" => (string)$this->eligibility,
                "competency" => (string)$this->competency,
            ],

        ];
    }
}
