<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoticeResource extends JsonResource
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
                "application_id" => (string)$this->application_id,
                "notice_type" => (string)$this->notice_type,
                "date_sent" => (string)$this->date_send,
                "date_received" => (string)$this->date_received,
                "application" => new ApplicationResource($this->whenLoaded('belongsToApplication'))
            ]
            
        ];
    }
}
