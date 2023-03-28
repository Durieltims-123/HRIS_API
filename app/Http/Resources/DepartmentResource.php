<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
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
                "department_code" => (string)$this->department_code,
                "department_name" => (string)$this->department_name,
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
