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
            "attributes" => [
                "employee_code" => (string)$this->employee_code,
                "employee_name" => (string)$this->employee_name,
                'offices' => $this->hasManyOffices->map(function ($offices) {
                    return [
                        'office_code' => $offices->office_code,
                        'office_name' => $offices->office_name,
                    ];
                }),

            ],


        ];
    }
}
