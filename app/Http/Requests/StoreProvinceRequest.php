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
            'permanent_province_name' => ['required', 'string', 'max:255'],
            'residential_province_name' => ['required', 'string', 'max:255'],

            //municipality
            // 'province_id' => ['required'],
            'residential_municipality_name' => ['required', 'string', 'max:255'],
            'residential_municipality_name' => ['required', 'string', 'max:255'],

            //barangay
            'residential_barangay_name' => ['required', 'string', 'max:255'],
            'residential_barangay_name' => ['required', 'string', 'max:255']
        ];
    }
}
