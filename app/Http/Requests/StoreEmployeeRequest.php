<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            // 'division_id' => ['required'],
            // 'first_name' => ['required', 'string', 'max:255'],
            // 'middle_name' => ['required', 'string', 'max:255'],
            // 'last_name' => ['required', 'string', 'max:255'],
            // 'suffix_name' => ['nullable'],
            // 'contact_number' => ['required', 'string', 'max:255'],
            // 'email_address' => ['required', 'string', 'max:255'],
            // 'current_position' => ['required', 'string', 'max:255'],
            // 'employment_status' => ['required', 'string', 'max:255'],
            // 'employee_status' => ['required', 'string', 'max:255'],
            // 'orientation_status' => ['required', 'string', 'max:255']

            'employee_id'  => ['required', 'string', 'max:15'],
            'employment_status' =>  ['required', 'string', 'max:255'],
            'division_id' =>  ['required'],
            'division' =>  ['required'],
            'division_autosuggest' =>  ['required'],
            'first_name' =>  ['required', 'string', 'max:255'],
            'middle_name' =>  ['max:255'],
            'last_name' =>  ['required', 'string', 'max:255'],
            'suffix' =>  ['string', 'max:255'],
            'birth_place' =>  ['required', 'string', 'max:255'],
            'birth_date' =>  ['required', 'max:255'],
            'age' =>  ['required', 'gt:0', 'digits_between:2,65'],
            'sex' =>  ['required'],
            'height' =>  ['required', 'gt:0', 'lt:8'],
            'weight' =>  ['required', 'gt:0', 'lt:1000'],
            'citizenship' =>  ['required'],
            'citizenship_type' =>  ['required_if:citizenship,==,Dual Citizenship'],
            'country' =>   ['required_if:citizenship,==,Dual Citizenship'],
            'blood_type' =>  ['required'],
            'civil_status' =>  ['required'],
            'tin' =>  ['required', 'max:12'],
            'gsis' =>  ['required', 'max:11', 'min:12'],
            'pagibig' =>  ['required', 'max:12', 'min:12'],
            'philhealth' =>  ['required', 'max:12', 'min:12'],
            'sss' =>  ['nullable', 'string', 'max:20',],
            'residential_province' =>  ['required', 'max:255'],
            'residential_municipality' =>  ['required', 'max:255'],
            'residential_barangay' =>  ['required', 'max:255'],
            'residential_house' =>  ['nullable', 'max:255'],
            'residential_subdivision' =>  ['nullable', 'max:255'],
            'residential_street' =>  ['nullable', 'max:255'],
            'residential_zipcode' =>  ['required', 'max:4'],
            'permanent_province' =>  ['required', 'max:255'],
            'permanent_municipality' =>  ['required', 'max:255'],
            'permanent_barangay' =>  ['required', 'max:255'],
            'permanent_house' =>  ['nullable', 'max:255'],
            'permanent_subdivision' =>  ['nullable', 'max:255'],
            'permanent_street' =>  ['nullable', 'max:255'],
            'permanent_zipcode' =>  ['required', 'max:4'],
            'telephone' =>  ['nullable', 'string', 'max:255'],
            'mobile' =>  ['required', 'max:11'],
            'email' =>  ['nullable', 'email', 'max:255'],


            'spouse_first_name' =>  ['required_with:spouse_last_name', 'nullable', 'max:255'],
            'spouse_middle_name' =>  ['nullable', 'max:255'],
            'spouse_last_name' =>  ['required_with:spouse_first_name', 'nullable', 'max:255'],
            'spouse_suffix' =>  ['nullable', 'max:255'],
            'spouse_employer' =>  ['required_with:spouse_employer_address', 'required_with:spouse_employer_telephone','nullable', 'max:255'],
            'spouse_employer_address' =>  ['required_with:spouse_employer','nullable', 'max:255'],
            'spouse_employer_telephone' =>  ['required_with:spouse_employer','nullable', 'max:255'],


            // 'children' => ['required', 'array'],
            'children.*.name' => ['required'],
            


            'father_first_name' =>  ['required', 'max:255'],
            'father_middle_name' =>  ['nullable'],
            'father_last_name' =>  ['required', 'max:255'],
            'father_suffix' =>  ['nullable'],
            'mother_first_name' =>  ['required'],
            'mother_middle_name' =>  ['nullable'],
            'mother_last_name' =>  ['required'],
            'mother_suffix' =>  ['nullable'],

            'schools' =>  ['required'],
            'eligibilities' =>  ['required'],
            'workExperiences' =>  ['required'],
            'voluntaryWorks' =>  ['required'],
            'trainings' =>  ['required'],
            'skills' =>  ['required'],
            'recognitions' =>  ['required'],
            'memberships' =>  ['required'],
            'answers' =>  ['required'],
            'characterReferences' =>  ['required']
        ];
    }
}
