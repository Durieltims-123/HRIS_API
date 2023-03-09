<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'first_name' => ['required', 'string'],
            'middle_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'suffix_name' => ['required', 'string'],
            'contact_number' => ['required', 'string'],
            'email_address' => ['required', 'string'],
            'current_position' => ['required', 'string', 'max:255'],
            'employment_status' => ['required', 'string', 'max:255'],
            'employee_status' => ['required', 'string', 'max:255'],
            'orientation_status' => ['required', 'string', 'max:255']
        ];
    }
}
