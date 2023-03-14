<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePositionRequest extends FormRequest
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
            //position
            'title' => ['required', 'string', 'max:255'],
            'salary_grade_id' =>['required'],
            // 'position_id' =>['required'],

            //qualification standard
            'education' => ['required', 'string', 'max:255'],
            'training' => ['required', 'string', 'max:255'],
            'experience' => ['required', 'string', 'max:255'],
            'eligibility' => ['required', 'string', 'max:255'],
            'competency' => ['required', 'string', 'max:255']
        ];
    }
}
