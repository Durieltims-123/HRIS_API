<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkExperienceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'position_title' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'monthly_salary' => ['required', 'string', 'max:255'],
            'salary' => ['required', 'string', 'max:255'],
            'status_appointment' => ['required', 'string', 'max:255'],
            'government_service' => ['required', 'string', 'max:255'],
            'inclusive_dates_from' => ['required', 'date'],
            'inclusive_dates_to' => ['required', 'date']
        ];
    }
}
