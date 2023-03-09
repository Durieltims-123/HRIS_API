<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFamilyBackgroundRequest extends FormRequest
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
            'spouse_surname' => ['required', 'string', 'max:255'],
            'spouse_first_name' => ['required', 'string', 'max:255'],
            'spouse_middle_name' => ['required', 'string', 'max:255'],
            'name_extension' => ['required', 'string', 'max:255'],
            'occupation' => ['required', 'string', 'max:255'],
            'employee_business_name' => ['required', 'string', 'max:255'],
            'business_address' => ['required', 'string', 'max:255'],
            'father_surname' => ['required', 'string', 'max:255'],
            'father_first_name' => ['required', 'string', 'max:255'],
            'father_middle_name' => ['required', 'string', 'max:255'],
            'father_extension_name' => ['required', 'string', 'max:255'],
            'mother_maiden_surname' => ['required', 'string', 'max:255'],
            'mother_first_name' => ['required', 'string', 'max:255'],
            'mother_maiden_middle_name' => ['required', 'string', 'max:255'],
           
        ];
    }
}
