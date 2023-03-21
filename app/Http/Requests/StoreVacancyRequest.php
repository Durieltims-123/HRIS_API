<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVacancyRequest extends FormRequest
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
            
            'position_title' => ['required', 'string', 'max:255'],
            'job_description' => ['required', 'string', 'max:255'],
            'plantilla_item_number' => ['required','string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'date_submitted' => ['required', 'date'],
            'date_queued' => ['required', 'date'],
            'date_approved' => ['required', 'date'],
            'office_name' => ['required', 'string', 'max:255'],
        ];
    }
}
