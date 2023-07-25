<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'position' => ['required'],
            'position_id' => ['required'],
            'date_submitted' => ['required', 'date'],
            'date_approved' => ['required_if:process,Approve', 'nullable', 'date', 'after_or_equal:date_submitted'],
            'posting_date' => ['required_if:process,Approve', 'nullable', 'date', 'after_or_equal:date_approved'],
            'closing_date' => ['required_if:process,Approve', 'nullable', 'date', 'after_or_equal:posting_date'],
            'date_queued' => ['required_if:process,Queue', 'nullable', 'date', 'after_or_equal:date_submitted'],
            'state' => "required",
            'status' => ['required', 'string', 'max:255'],
        ];
    }
}
