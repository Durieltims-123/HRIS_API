<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
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
            'applicant_id' => ['nullable', 'string', 'max:255'],
            'employee_id' => ['nullable', 'string', 'max:255'],
            'publication_id' => ['required', 'string', 'max:255'],
            'submission_date' => ['required', 'date'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable','string', 'max:255'],
            'application_type' => ['required', 'string', 'max:255'],
            // 'status' => ['required', 'string', 'max:255'],
        ];
    }
}
