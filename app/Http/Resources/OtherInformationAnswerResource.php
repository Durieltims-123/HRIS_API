<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OtherInformationAnswerResource extends JsonResource
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
                "answer" => (string)$this->answer,
                "remarks" => (string)$this->remarks,

            ]
        ];
    }
}
