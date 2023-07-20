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
            'date_approved' => ['exclude_unless::process,Approve','required'],
            // 'scheduled_opening' => ['required_if:process,Approve', 'after:date_submitted'],
            // 'scheduled_closing' => ['required_if:process,Approve', 'exclude_if:process,!=,Approve|date|after:scheduled_opening'],
            // 'date_queued' => ['required_if:process,Queue', 'exclude_if:process,!=,Approve|date|after:date_submitted'],
            'status' => ['required', 'string', 'max:255'],
        ];
    }
}
