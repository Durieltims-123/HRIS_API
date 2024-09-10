<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [

            "employment_status" => ['required'],
            'nature_of_appointment' => ['required'],
            'division' => ['required'],
            'vice' => ['required'],
            'vice_reason' => ['required'],
            'date_of_signing' => ['required'],
            'page_no' => ['required'],
            'date_received' => ['required', 'after_or_equal:date_of_signing'],
            'application' => ['required_if:employment_status,permanent'],
            'employee' => ['required_if:employment_status,!=,permanent'],
        ];
    }
}
