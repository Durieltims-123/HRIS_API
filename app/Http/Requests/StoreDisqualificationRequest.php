<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDisqualificationRequest extends FormRequest
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
            'application_id' => ['required', 'string', 'max:255'],
            'date_disqualified' => ['required', 'date'],
            'reason' => ['required', 'string', 'max:255'],

            'member_id' => ['nullable', 'numeric', 'max:255'],
            'training' => ['nullable', 'numeric', 'max:255'],
            'performance' => ['nullable', 'numeric', 'max:255'],
            'education' => ['nullable', 'numeric', 'max:255'],
            'experience' => ['nullable', 'numeric', 'max:255'],
            
        ];
    }
}
