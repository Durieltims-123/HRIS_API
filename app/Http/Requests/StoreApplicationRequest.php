<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
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
            'first_name' =>  ['required', 'string', 'max:255'],
            'middle_name' =>  ['max:255'],
            'last_name' =>  ['required', 'string', 'max:255'],
            'suffix' =>  ['nullable', 'string', 'max:255'],
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
            'gsis' =>  ['required', 'max:12', 'min:12'],
            'pagibig' =>  ['required', 'max:12', 'min:12'],
            'philhealth' =>  ['required', 'max:12', 'min:12'],
            'sss' =>  ['nullable', 'string', 'max:20',],
            'residential_province' =>  ['required', 'max:255'],
            'residential_municipality' =>  ['required', 'max:255'],
            'residential_barangay' =>  ['required', 'max:255'],
            'residential_house' =>  ['required', 'max:255'],
            'residential_subdivision' =>  ['nullable', 'max:255'],
            'residential_street' =>  ['nullable', 'max:255'],
            'residential_zipcode' =>  ['required', 'max:4'],
            'permanent_province' =>  ['required', 'max:255'],
            'permanent_municipality' =>  ['required', 'max:255'],
            'permanent_barangay' =>  ['required', 'max:255'],
            'permanent_house' =>  ['required', 'max:255'],
            'permanent_subdivision' =>  ['nullable', 'max:255'],
            'permanent_street' =>  ['nullable', 'max:255'],
            'permanent_zipcode' =>  ['required', 'max:4'],
            'telephone' =>  ['nullable', 'string', 'max:255'],
            'mobile_number' =>  ['required', 'max:11'],
            'email_address' =>  ['nullable', 'email', 'max:255'],


            'spouse_first_name' =>  ['required_with:spouse_last_name', 'nullable', 'max:255'],
            'spouse_middle_name' =>  ['nullable', 'max:255'],
            'spouse_last_name' =>  ['required_with:spouse_first_name', 'nullable', 'max:255'],
            'spouse_suffix' =>  ['nullable', 'max:255'],
            'spouse_occupation' =>  ['nullable', 'max:255'],
            'spouse_employer' =>  ['required_with:spouse_employer_address', 'required_with:spouse_employer_telephone', 'nullable', 'max:255'],
            'spouse_employer_address' =>  ['required_with:spouse_employer', 'nullable', 'max:255'],
            'spouse_employer_telephone' =>  ['required_with:spouse_employer', 'nullable', 'max:255'],


            'children.*.name' => ['required', 'max:255'],
            'children.*.birthday' => ['required', 'max:255'],


            'father_first_name' =>  ['required', 'max:255'],
            'father_middle_name' =>  ['nullable', 'max:255'],
            'father_last_name' =>  ['required', 'max:255'],
            'father_suffix' =>  ['nullable', 'max:255'],
            'mother_first_name' =>  ['required', 'max:255'],
            'mother_middle_name' =>  ['nullable', 'max:255'],
            'mother_last_name' =>  ['required', 'max:255'],
            'mother_suffix' =>  ['nullable', 'max:255'],


            'schools.*.level' => ['required', 'max:255'],
            'schools.*.school_name' => ['required', 'max:255'],
            'schools.*.degree' => ['nullable', 'max:255', 'required_if:schools.*.level,==,Vocational/Trade Course', 'required_if:schools.*.level,==,College', 'required_if:schools.*.level,==,Masters', 'required_if:schools.*.level,==,Doctorate'],
            'schools.*.period_from' => ['required', 'max:4'],
            'schools.*.period_to' => ['required', 'max:4', 'after:schools.*.period_from'],
            'schools.*.highest_unit_earned' => ['nullable', 'max:255', 'required_if:schools.*.level,==,Vocational/Trade Course', 'required_if:schools.*.level,==,College'],
            'schools.*.year_graduated' => ['nullable', 'max:255'],
            'schools.*.scholarship_academic_awards' => ['nullable', 'max:255'],

            'eligibilities.*.eligibility_title' => ['required', 'max:255'],
            'eligibilities.*.rating' => ['required', 'max:255', 'gte:75', 'lte:100'],
            'eligibilities.*.date_of_examination_conferment' => ['required', 'max:255'],
            'eligibilities.*.place_of_examination_conferment' => ['required', 'max:255'],
            'eligibilities.*.license_number' => ['nullable', 'max:255'],
            'eligibilities.*.license_date_validity' => ['nullable', 'max:255'],

            'workExperiences.*.date_from' => ['required', 'max:255'],
            'workExperiences.*.date_to' => ['required', 'max:255', 'after:workExperiences.*.date_from'],
            'workExperiences.*.position_title' => ['required', 'max:255'],
            'workExperiences.*.office_company' => ['required', 'max:255'],
            'workExperiences.*.monthly_salary' => ['required', 'max:255'],
            'workExperiences.*.salary_grade' => ['nullable', 'max:255'],
            'workExperiences.*.status_of_appointment' => ['required', 'max:255'],
            'workExperiences.*.government_service' => ['required', 'max:255'],

            'voluntaryWorks.*.organization_name' => ['required', 'max:255'],
            'voluntaryWorks.*.organization_address' => ['required', 'max:255'],
            'voluntaryWorks.*.date_from' => ['required', 'max:255'],
            'voluntaryWorks.*.date_to' => ['required', 'max:255', 'after:voluntaryWorks.*.date_from'],
            'voluntaryWorks.*.number_of_hours' => ['required', 'max:255'],
            'voluntaryWorks.*.position_nature_of_work' => ['required', 'max:255'],

            'trainings.*.training_title' => ['required', 'max:255'],
            'trainings.*.attendance_from' => ['required', 'max:255'],
            'trainings.*.attendance_to' => ['required', 'max:255', 'after:trainings.*.attendance_from'],
            'trainings.*.number_of_hours' => ['required', 'max:255', 'lt:1000'],
            'trainings.*.training_type' => ['required', 'max:255'],
            'trainings.*.conducted_sponsored_by' => ['required', 'max:255'],

            'skills.*.special_skill' =>  ['required', 'max:255'],
            'recognitions.*.recognition_title' =>  ['required', 'max:255'],
            'memberships.*.organization' =>  ['required', 'max:255'],

            'characterReferences.*.name' =>  ['required', 'max:255'],
            'characterReferences.*.address' =>  ['required', 'max:255'],
            'characterReferences.*.number' =>  ['required', 'max:11'],
            'date_submitted' =>  ['required'],
            'attachments' =>  ['required'],
            'vacancy' =>  ['required'],


        ];
    }
}
