<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicationInterviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ([
            "id" => (string)$this->id,
            "attributes"=>[
                
                "publication_id" => (string)$this->publication_id,
                "interview_id" => (string)$this->interview_id,
                "publication"=> new PublicationResource($this->whenLoaded('belongsToPublication')),
                
            ]
            ]);
    }
}
