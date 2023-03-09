<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
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
                "submission_date" => (string)$this->submission_date,
                "first_name" => (string)$this->first_name,
                "middle_name" => (string)$this->middle_name,
                "last_name" => (string)$this->last_name,
                "suffix_name" => (string)$this->suffix_name,
                "application_type" => (string)$this->application_type,
                "status" => (string)$this->status,
            ]
        ];
    }
}
