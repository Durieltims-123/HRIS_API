<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLguPositionRequest extends FormRequest
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
            'division_id' => ['required'],
            'position_id' => ['required'],
            'item_number' => ['required_if:position_status,==,Permanent','max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'place_of_assignment' => ['nullable', 'string', 'max:255'],
            'year' => ['required'],
            'position_status' => ['required', 'string'],
            'status' => ['required'],
        ];
    }
}
