<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnswerRequest extends FormRequest
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
            'personal_data_sheet_id' => ['required'],
            'question_id' => ['required'],
            'choice' => ['required', 'string', 'max:255'],
            'details' => ['nullable'],
            'date_filed' => ['nullable'],
            'case_status' => ['nullable']
        ];
    }
}
