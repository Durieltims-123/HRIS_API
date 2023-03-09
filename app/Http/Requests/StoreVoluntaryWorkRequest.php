<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVoluntaryWorkRequest extends FormRequest
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
            'organization_name' => ['required', 'string', 'max:255'],
            'organization_address' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'number_hours' => ['required', 'string', 'max:255'],
            'inclusive_dates_from' => ['required', 'date'],
            'inclusive_dates_to' => ['required', 'date']
        ];
    }
}
