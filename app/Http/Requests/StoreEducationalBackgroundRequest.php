<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEducationalBackgroundRequest extends FormRequest
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
            'level' => ['required', 'string', 'max:255'],
            'school_name' => ['required', 'string', 'max:255'],
            'basic_education' => ['required', 'string', 'max:255'],
            'scholarship_honor' => ['required', 'string', 'max:255'],
            'highest_level' => ['required', 'string', 'max:255'],
            'year_graduated' => ['required', 'string', 'max:255'],
            'inclusive_dates_from' => ['required', 'date'],
            'inclusive_dates_to' => ['required', 'date']
        ];
    }
}
