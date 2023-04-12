<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOathTakingRequest extends FormRequest
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
            'venue' => ['required', 'string', 'max:255'],
            'date_generated' => ['required', 'date'],
            'oath_date' => ['required', 'date'],
            'appointment_id' => ['required'],
            'first_name' => ['required'],
            'last_name' =>['required'],
            'department' =>['required'],
            'job_title' =>['required'],
            'date_appointed' => ['required'],
        ];
    }
}
