<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class ShortlistApplicationRequest extends FormRequest
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
            'shortlist_trainings' => ['required', 'string', 'max:255'],
            'performance' => ['required', 'numeric', 'min:0', 'max:20'],
            'education' => ['required', 'numeric', 'min:0', 'max:20'],
            'experience' => ['required', 'numeric', 'min:0', 'max:25'],
        ];
    }
}
