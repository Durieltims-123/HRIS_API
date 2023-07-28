<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRecordFormRequest extends FormRequest
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
            'employee_id' => ['required'],
            'date_from' => ['required', 'string', 'max:255'],
            'date_to' => ['required', 'string', 'max:255'],
            'appointment_records' => ['required', 'string', 'max:255'],
            'leave_without_pay' => ['required', 'string', 'max:255'],
            'remarks' => ['required', 'string', 'max:255'],
            'civil_status' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'salary_annum' => ['required', 'string', 'max:255'],
            'division_office' => ['required', 'string', 'max:255'],
        ];
    }
}
