<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCivilServiceEligibilityRequest extends FormRequest
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
            'career_service' => ['required', 'string', 'max:255'],
            'rating' => ['required', 'numeric', 'max:255'],
            'examination_date' => ['required', 'date'],
            'place_examination' => ['required', 'string', 'max:255'],
            'license_number' => ['required', 'string', 'max:255'],
            'date_validity' => ['required', 'date']
        ];
    }
}
