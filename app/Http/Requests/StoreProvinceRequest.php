<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProvinceRequest extends FormRequest
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
            //province
            'province_name' => ['required', 'string', 'max:255'],
            'province_code' => ['nullable', 'string', 'max:255'],
            
            //municipality
            'province_id' => ['required'],
            'municipality_name' => ['required', 'string', 'max:255'],
            'municipality_code' => ['nullable', 'string', 'max:255'],

            //barangay
            'municipality_id' => ['required'],
            'barangay_name' => ['required', 'string', 'max:255'],
            'barangay_code' => ['nullable', 'string', 'max:255'],
        ];
    }
}
