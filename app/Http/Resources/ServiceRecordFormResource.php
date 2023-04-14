<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceRecordFormResource extends JsonResource
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
                "date_from" => (string)$this->date_from,
                "date_to" => (string)$this->date_to,
                "appointment_records" => (string)$this->appointment_records,
                "leave_without_pay" => (string)$this->leave_without_pay,
                "civil_status" => (string)$this->civil_status,
                "designation" =>(string)$this->designation,
                "salary_annum" => (string)$this->salary_annum,
                "office_department" => (string)$this->office_department,
            ]
            ];
    }
}
