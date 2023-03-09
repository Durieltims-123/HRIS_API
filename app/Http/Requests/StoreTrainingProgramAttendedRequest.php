<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainingProgramAttendedRequest extends FormRequest
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
            'program_title' => ['required', 'string', 'max:255'],
            'hours' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'conducted_by' => ['required', 'string', 'max:255'],
            'inclusive_dates_from' => ['required', 'date'],
            'inclusive_dates_to' => ['required', 'date']
        ];
    }
}
