<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonalDataSheetRequest extends FormRequest
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

            //personal data sheet
            'applicant_id' => ['nullable'],
            'employee_id' => ['nullable'],

            //personal information
            'personal_data_sheet_id' => ['required'],
            'mobile_number' => ['required', 'string', 'max:255'],
            'telephone_number' => ['required', 'string', 'max:255'],
            'permanent_house_number' => ['required', 'string', 'max:255'],
            'permanent_subdivision_village' => ['required', 'string', 'max:255'],
            'permanent_street' => ['required', 'string', 'max:255'],
            'barangay_id' => ['required'],
            'municipality_id' => ['required'],
            'province_id' => ['required'],
            'permanent_zip_code' => ['required', 'string', 'max:255'],
            'residential_house_number' => ['required', 'string', 'max:255'],
            'residential_subdivision_village' => ['required', 'string', 'max:255'],
            'residential_street' => ['required', 'string', 'max:255'],
            'r_barangay_id' => ['required'],
            'r_municipality_id' => ['required'],
            'r_province_id' => ['required'],
            'residential_zip_code' => ['required', 'string', 'max:255'],
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
            'birthdate' => ['required', 'date'],


            //family background
            'personal_data_sheet_id' => ['required'],
            'spouse_surname' => ['required', 'string', 'max:255'],
            'spouse_first_name' => ['required', 'string', 'max:255'],
            'spouse_middle_name' => ['required', 'string', 'max:255'],
            'suffix_name' => ['nullable'],
            'occupation' => ['required', 'string', 'max:255'],
            'employee_business_name' => ['required', 'string', 'max:255'],
            'business_address' => ['required', 'string', 'max:255'],
            'telephone_number' => ['required', 'string', 'max:255'],
            'father_surname' => ['required', 'string', 'max:255'],
            'father_first_name' => ['required', 'string', 'max:255'],
            'father_middle_name' => ['required', 'string', 'max:255'],
            'father_extension_name' => ['nullable'],
            'mother_maiden_surname' => ['required', 'string', 'max:255'],
            'mother_first_name' => ['required', 'string', 'max:255'],
            'mother_maiden_middle_name' => ['required', 'string', 'max:255'],

            //children information
            'personal_data_sheet_id' => ['required'],
            'family_background_id' => ['required'],
            'children_name' => ['nullable'],
            'children_birthdate' => ['nullable'],

            //educational background
            'personal_data_sheet_id' => ['required'],
            'level' => ['required', 'string', 'max:255'],
            'school_name' => ['required', 'string', 'max:255'],
            'basic_education' => ['required', 'string', 'max:255'],
            'scholarship_honor' => ['required', 'string', 'max:255'],
            'highest_level' => ['required', 'string', 'max:255'],
            'year_graduated' => ['required', 'string', 'max:255'],
            'eb_inclusive_dates_from' => ['required', 'date'],
            'eb_inclusive_dates_to' => ['required', 'date'],

            //civil sercvice eligibility
            'personal_data_sheet_id' => ['required'],
            'career_service' => ['required','max:255'],
            'rating' => ['nullable'],
            'examination_date' => ['required'],
            'place_examination' => ['required','max:255'],
            'license_number' => ['required','max:255'],
            'date_validity' => ['required'],

            //work experience
            'personal_data_sheet_id' => ['required'],
            'position_title' => ['required','max:255'],
            'department' => ['required','max:255'],
            'monthly_salary' => ['required'],
            'salary' => ['required','max:255'],
            'status_appointment' => ['required','max:255'],
            'government_service' => ['required','max:255'],
            'inclusive_dates_from' => ['required',],
            'inclusive_dates_to' => ['required'],

            //vountary work
            'personal_data_sheet_id' => ['required'],
            'organization_name' => ['required','max:255'],
            'organization_address' => ['required','max:255'],
            'position' => ['required'],
            'number_hours' => ['required','max:255'],
            'vw_inclusive_dates_from' => ['required',],
            'vw_inclusive_dates_to' => ['required'],

            //training program attended
            'personal_data_sheet_id' => ['required'],
            'program_title' => ['required','max:255'],
            'hours' => ['required','max:255'],
            'type' => ['required'],
            'conducted_by' => ['required','max:255'],
            'tp_inclusive_dates_from' => ['required',],
            'tp_inclusive_dates_to' => ['required'],
        
            //special skills
            'personal_data_sheet_id' => ['required'],
            'special_skills' => ['required','max:255'],

            //recognition
            'personal_data_sheet_id' => ['required'],
            'recognition_title' => ['required','max:255'],

            //membership association
            'personal_data_sheet_id' => ['required'],
            'membership_association' => ['nullable'],

            //answer
            'personal_data_sheet_id' => ['required'],
            'question_id' => ['required'],
            'choice' => ['required','max:255'],
            'details' => ['nullable'],
            'date_filed' => ['nullable'],
            'case_status' => ['nullable'],

            //references
            'personal_data_sheet_id' =>['required'],
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'telephone_number' => ['required', 'string', 'max:255'],
            'name2' => ['required', 'string', 'max:255'],
            'address2' => ['required', 'string', 'max:255'],
            'telephone_number2' => ['required', 'string', 'max:255'],
            'name3' => ['required', 'string', 'max:255'],
            'address3' => ['required', 'string', 'max:255'],
            'telephone_number3' => ['required', 'string', 'max:255'],

        ];
    }
}
