<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInterviewRequest extends FormRequest
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
            'date_created' => ['required', 'date', 'before:meeting_date'],
            'meeting_date' => ['required', 'date'],
            'venue' => ['required', 'max:255'],
            'positions' => ['required'],
        ];
    }
}
