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
            'training' => ['required', 'numeric', 'max:255'],
            'performance' => ['required', 'numeric', 'max:255'],
            'education' => ['required', 'numeric', 'max:255'],
            'experience' => ['required', 'numeric', 'max:255'],
            'psychological_attribute' => ['nullable', 'numeric', 'max:255'],
            'potential' => ['nullable', 'numeric', 'max:25'],
            'awards' => ['nullable', 'numeric', 'max:25'],
            'additional_information' => ['nullable', 'string', 'max:255'],
            'remarks' => ['nullable', 'string', 'max:255'],
            // 'date_of_assessment' => ['nullable', 'date']
        ];
    }
}
