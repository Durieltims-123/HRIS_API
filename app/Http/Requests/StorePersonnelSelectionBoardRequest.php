<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonnelSelectionBoardRequest extends FormRequest
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
            'date_of_effectivity' => ['required', 'date'],
            'end_of_effectivity' => ['nullable', 'date', 'after:date_of_effectivity'],
            'chairman' => ['required', 'string', 'max:255'],
            'chairman_position' => ['required', 'string', 'max:255'],
            'chairman_prefix' => ['required', 'string', 'max:255'],
            'chairman_office' => ['required', 'string', 'max:255'],
            'vice_chairman' => ['required', 'string', 'max:255'],
            'vice_chairman_position' => ['required', 'string', 'max:255'],
            'vice_chairman_prefix' => ['required', 'string', 'max:255'],
            'vice_chairman_office' => ['required', 'string', 'max:255'],
            'members.*.prefix' => ['required', 'max:255'],
            'members.*.name' => ['required', 'max:255'],
            'members.*.position' => ['required', 'max:255'],
            'members.*.office' => ['required', 'max:255'],
        ];
    }
}
