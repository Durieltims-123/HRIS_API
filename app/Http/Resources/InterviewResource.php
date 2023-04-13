<?php

namespace App\Http\Resources;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InterviewResource extends JsonResource
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
                
                "interview_date" => (string)$this->interview_date,
                "venue" => (string)$this->venue,
                
                "publicationInterview"=>  PublicationInterviewResource::collection($this->whenLoaded('publicationInterview')),
                // "application" => new ApplicationResource($this->whenLoaded('hasOneApplication')),
            ]
            
        ];
    }
}
