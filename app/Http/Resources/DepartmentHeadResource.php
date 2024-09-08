<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentHeadResource extends JsonResource
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
            "label" => (string)$this->division_name,
            "attributes" => [
                "office_name" => (string)$this->office_name,
                "prefix" => (string) $this->prefix,
                "name" => (string) $this->name,
                "position" => (string) $this->position,
                "status" => (string) $this->status
            ]

        ];
    }
}
