<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQualificationStandardRequest extends FormRequest
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
            'salary_grade_id' =>['required'],
            'education' => ['required', 'string', 'max:255'],
            'training' => ['required', 'string', 'max:255'],
            'experience' => ['required', 'string', 'max:255'],
            'eligibility' => ['required', 'string', 'max:255'],
            'competency' => ['required', 'string', 'max:255']
        ];
    }
}
