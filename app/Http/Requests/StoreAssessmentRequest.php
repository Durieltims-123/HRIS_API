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
            'application_id' => ['required'],
            'member_id' => ['required'],
            'training' => ['required'],
            'performance' => ['required'],
            'education' => ['required'],
            'experience' => ['required'],
            'psychosocial_attribute' => ['nullable'],
            'potential' => ['nullable'],
            'awards' => ['nullable'],
            'additional_information' => ['nullable'],
            'remarks' => ['nullable'],
            'date_of_assessment' => ['required']
        ];
    }
}
