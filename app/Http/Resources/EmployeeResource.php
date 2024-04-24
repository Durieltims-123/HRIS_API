<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            "attributes" =>
            [
                "employee_id" => (string)$this->employee_id,
                "first_name" => (string)$this->first_name,
                "middle_name" => (string)$this->middle_name,
                "last_name" => (string)$this->last_name,
                "suffix" => (string)$this->suffix,
                "mobile_number" => (string)$this->mobile_number,
                "email_address" => (string)$this->email_address,
                "title" => (string)$this->title,
                "position_status" => (string)$this->position_status,
                "employee_status" => (string)$this->employee_status,
                "orientation_status" => (string)$this->orientation_status,
                "item_number" => (string)$this->item_number
            ]
        ];
    }
}
