<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return 
        [
            "id" => (string)$this->id,
            "attributes" => 
            [
                "choice" => (string)$this->choice,
                "details" => (string)$this->details,
                "date_filed" => (string)$this->date_filed,
                "case_status" => (string)$this->case_status
            ]
        ];
    }
}
