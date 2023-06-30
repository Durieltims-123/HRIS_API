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
            'lgu_position_id' => ['required'],
            'date_submitted' => ['required', 'date'],
            'date_queued' => ['nullable','date'],
            'date_approved' => ['nullable','date'],
            'status' => ['required', 'string', 'max:255'],
        ];
    }
}
