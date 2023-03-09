<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssessmentRequest extends FormRequest
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
            'psychological_attribute' => ['required', 'numeric', 'max:255'],
            'potential' => ['required', 'numeric', 'max:25'],
            'awards' => ['required', 'numeric', 'max:25'],
            'additional_information' => ['required', 'string', 'max:255'],
            'remarks' => ['required', 'string', 'max:255'],
            'date_of_assessment' => ['required', 'date']
        ];
    }
}
