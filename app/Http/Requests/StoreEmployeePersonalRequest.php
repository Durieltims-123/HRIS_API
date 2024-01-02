<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeePersonalRequest extends FormRequest
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
            'employee_id'  => ['required', 'string', 'max:15'],
            'employment_status' =>  ['required', 'string'],
            'division_id' =>  ['required'],
            'division' =>  ['required'],
            'division_autosuggest' =>  ['required'],
            'first_name' =>  ['required'],
            'last_name' =>  ['required'],
            'suffix' =>  ['string'],
            'birth_place' =>  ['required'],
            'birth_date' =>  ['required'],
            'age' =>  ['required', 'gt:0'],
            'sex' =>  ['required'],
            'height' =>  ['required', 'gt:0'],
            'weight' =>  ['required', 'gt:0'],
            'citizenship' =>  ['required'],
            'citizenship_type' =>  ['required_if:citizenship,==,Dual Citizenship'],
            'country' =>   ['required_if:citizenship,==,Dual Citizenship'],
            'blood_type' =>  ['required'],
            'civil_status' =>  ['required'],
            'tin' =>  ['required'],
            'gsis' =>  ['required'],
            'pagibig' =>  ['required'],
            'philhealth' =>  ['required'],
            'sss' =>  ['nullable', 'string'],
            'residential_province' =>  ['required'],
            'residential_municipality' =>  ['required'],
            'residential_barangay' =>  ['required'],
            'residential_house' =>  ['required'],
            'residential_subdivision' =>  ['required'],
            'residential_street' =>  ['required'],
            'residential_zipcode' =>  ['required'],
            'permanent_province' =>  ['required'],
            'permanent_municipality' =>  ['required'],
            'permanent_barangay' =>  ['required'],
            'permanent_house' =>  ['required'],
            'permanent_subdivision' =>  ['required'],
            'permanent_street' =>  ['required'],
            'permanent_zipcode' =>  ['required'],
            'telephone' =>  ['nullable', 'string'],
            'mobile' =>  ['required'],
            'email' =>  ['nullable', 'email'],
        ];
    }
}
