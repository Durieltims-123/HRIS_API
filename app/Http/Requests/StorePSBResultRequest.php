<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePSBResultRequest extends FormRequest
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
            'vacancy_id' => ['required'],
            'applications.*.psychosocial_attributes' => ['required_if:position,==,Non-Department Head', 'numeric', 'min:0', 'max:15'],
            'applications.*.potential' => ['required_if:position,==,Non-Department Head', 'numeric', 'min:0', 'max:15'],
            'applications.*.administrative' => ['required_if:position,==,Department Head', 'numeric', 'min:0', 'max:10'],
            'applications.*.technical' => ['required_if:position,==,Department Head', 'numeric', 'min:0', 'max:10'],
            'applications.*.leadership' => ['required_if:position,==,Department Head', 'numeric', 'min:0', 'max:10'],
            'applications.*.awards' => ['required', 'numeric', 'min:0', 'max:5'],
            'position' => ['required']
        ];
    }
}
