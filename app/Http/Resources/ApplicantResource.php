<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
            [
                "id" => (string)$this->id,
                "attributes" =>
                [
                    "first_name" => (string)$this->first_name,
                    "middle_name" => (string)$this->middle_name,
                    "last_name" => (string)$this->last_name,
                    "suffix" => (string)$this->suffix,
                    "mobile_number" => (string)$this->mobile_number,
                    "email_address" => (string)$this->email_address,
                    // "first_name" => (string)$this->belongsToApplicant[0]->first_name,
                    // "middle_name" => (string)$this->belongsToApplicant[0]->middle_name,
                    // "last_name" => (string)$this->belongsToApplicant[0]->last_name,
                    // "suffix" => (string)$this->belongsToApplicant[0]->suffix,
                    // "mobile_number" => (string)$this->belongsToApplicant[0]->mobile_number,
                    // "email_address" =>(string)$this->belongsToApplicant[0]->email_address,
                ]
            ];
    }
}
