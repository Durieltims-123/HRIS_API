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

            'employee_id'  => ['required','string', 'max:255'],
            'employee_type' =>  ['required','string', 'max:255'],
            'division_id' =>  ['required'],
            'division' =>  ['required'],
            'division_autosuggest' =>  ['required'],
            'first_name' =>  ['required'],
            'middle_name' =>  ['required'],
            'last_name' =>  ['required'],
            'suffix' =>  ['required'],
            'birth_place' =>  ['required'],
            'birth_date' =>  ['required'],
            'age' =>  ['required'],
            'sex' =>  ['required'],
            'height' =>  ['required'],
            'weight' =>  ['required'],
            'citizenship' =>  ['required'],
            'citizenship_type' =>  ['required'],
            'country' =>  ['required'],
            'blood_type' =>  ['required'],
            'civil_status' =>  ['required'],
            'tin' =>  ['required'],
            'gsis' =>  ['required'],
            'pagibig' =>  ['required'],
            'philhealth' =>  ['required'],
            'sss' =>  ['required'],
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
            'telephone' =>  ['required'],
            'mobile' =>  ['required'],
            'email' =>  ['required'],
            'spouse_first_name' =>  ['required'],
            'spouse_middle_name' =>  ['required'],
            'spouse_last_name' =>  ['required'],
            'spouse_suffix' =>  ['required'],
            'spouse_occupation' =>  ['required'],
            'spouse_employer' =>  ['required'],
            'spouse_employer_address' =>  ['required'],
            'spouse_employer_telephone' =>  ['required'],
            'children' => ['required'],
            'father_first_name' =>  ['required'],
            'father_middle_name' =>  ['required'],
            'father_last_name' =>  ['required'],
            'father_suffix' =>  ['required'],
            'mother_first_name' =>  ['required'],
            'mother_middle_name' =>  ['required'],
            'mother_last_name' =>  ['required'],
            'mother_suffix' =>  ['required'],
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
