<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrientationResource extends JsonResource
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
                "date_generated" => (string)$this->date_generated,
                "start_date" => (string)$this->start_date,
                "end_date" => (string)$this->end_date,
                "venue" => (string)$this->venue,
            ]
        ];
    }
}
