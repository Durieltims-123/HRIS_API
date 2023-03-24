<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlantillaRequest extends FormRequest
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
            'office_id' => ['required'],
            'position_id' => ['required'],
            'item_number' => ['required', 'string', 'max:255'],
            'place_of_assignment' => ['nullable', 'string', 'max:255'],
            'year' => ['required', 'string']
        ];
    }
}
