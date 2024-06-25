<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GovernorResource extends JsonResource
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
                "prefix" => (string)$this->prefix,
                "name" => (string)$this->name,
                "suffix" => (string)$this->suffix,
                "full_name" => (string)$this->prefix . " " . (string)$this->name . " " . (string)$this->suffix,
            ]

        ];
    }
}
