<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonalInformationRequest extends FormRequest
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
            //personal information
            'pds_id' =>['required'],
            'mobile_number' => ['required', 'string', 'max:255'],
            'telephone_number' => ['required', 'string', 'max:255'],
            'permanent_house_number' => ['required', 'string', 'max:255'],
            'permanent_subdivision_village' => ['required', 'string', 'max:255'],
            'permanent_street' => ['required', 'string', 'max:255'],
            'permanent_barangay_id' => ['required'],
            'permanent_municipality_id' => ['required'],
            'permanent_province_id' => ['required'],
            'permanent_zip_code_number' => ['required', 'string', 'max:255'],
            'residential_house_number' => ['required', 'string', 'max:255'],
            'residential_subdivision_village' => ['required', 'string', 'max:255'],
            'residential_street' => ['required', 'string', 'max:255'],
            'residential_barangay_id' => ['required'],
            'residential_municipality_id' => ['required'],
            'residential_province_id' => ['required'],
            'residential_zip_code_number' => ['required', 'string', 'max:255'],
            'citizenship' => ['required', 'string', 'max:255'],
            'agency_employee' => ['required', 'string', 'max:255'],
            'tin_number' => ['required', 'string', 'max:255'],
            'sss_number' => ['required', 'string', 'max:255'],
            'philhealth_number' => ['required', 'string', 'max:255'],
            'pag_ibig_number' => ['required', 'string', 'max:255'],
            'gsis_number' => ['required', 'string', 'max:255'],
            'blood_type' => ['required', 'string', 'max:255'],
            'weight' => ['required', 'string', 'max:255'],
            'height' => ['required', 'string', 'max:255'],
            'civil_status' => ['required', 'string', 'max:255'],
            'sex' => ['required', 'string', 'max:255'],
            'birthplace' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],

            //Recognition
            // 'pds_id' =>['required'],
            // 'recognition_title' => ['required', 'string', 'max:255'],
        ];
    }
}
