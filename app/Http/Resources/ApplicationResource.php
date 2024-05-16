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
            "attributes" => [
                'office_name' => $this->office_name,
                'division_name' => $this->division_name,
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'last_name' => $this->last_name,
                'suffix' => $this->suffix,
                'title' => $this->title,
                'item_number' => $this->item_number,
                'application_type' => $this->application_type,
                'status' => $this->status,
            ]
        ];
    }
}
