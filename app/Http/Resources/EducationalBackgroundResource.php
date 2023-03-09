<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationalBackgroundResource extends JsonResource
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
                "level" => (string)$this->level,
                "school_name" => (string)$this->school_name,
                "basic_education" => (string)$this->basic_education,
                "scholarship_honor" => (string)$this->scholarship_honor,
                "highest_level" => (string)$this->highest_level,
                "year_graduated" => (string)$this->year_graduated,
                "inclusive_dates_from" => (string)$this->inclusive_dates_from,
                "inclusive_dates_to" => (string)$this->inclusive_dates_to,
                
            ]
            
        ];
    }
}
