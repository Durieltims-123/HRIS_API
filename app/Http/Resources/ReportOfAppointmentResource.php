<?php

namespace App\Http\Resources;

use App\Models\ReportAppointment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportOfAppointmentResource extends JsonResource
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
                "reports" => (string)$this->reports,
                "report_date" => (string)$this->report_date,
                "report_appointment" => ReportAppointmentResource::collection($this->whenLoaded('hasManyReportAppointment'))
            ]
            
        ];
    }
}
