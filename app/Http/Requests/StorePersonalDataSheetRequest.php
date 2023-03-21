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
            //applicant
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'suffix_name' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'max:255'],
            'email_address' => ['required', 'string', 'max:255'],

            'applicant_id' =>['required'],

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
             'birthdate' => ['required', 'date'],

             //recognition
             'pds_id' =>['required'],
             'recognition_title' => ['required', 'string', 'max:255'],

            //family background
             'pds_id' =>['required'],
             'spouse_surname' => ['required', 'string', 'max:255'],
             'spouse_first_name' => ['required', 'string', 'max:255'],
             'spouse_middle_name' => ['required', 'string', 'max:255'],
             'name_extension' => ['required', 'string', 'max:255'],
             'occupation' => ['required', 'string', 'max:255'],
             'employee_business_name' => ['required', 'string', 'max:255'],
             'business_address' => ['required', 'string', 'max:255'],
             'telephone_number' => ['required', 'string', 'max:255'],
             'father_surname' => ['required', 'string', 'max:255'],
             'father_first_name' => ['required', 'string', 'max:255'],
             'father_middle_name' => ['required', 'string', 'max:255'],
             'father_extension_name' => ['required', 'string', 'max:255'],
             'mother_maiden_surname' => ['required', 'string', 'max:255'],
             'mother_first_name' => ['required', 'string', 'max:255'],
             'mother_maiden_middle_name' => ['required', 'string', 'max:255'],
                  
            //  //children information
            // //  'pds_id' =>['required'],
            //  'family_background_id' =>['required'],
            //  'children_name' => ['required', 'string', 'max:255'],
            //  'children_birthdate' => ['required', 'date'],

            //educational background
            'pds_id' =>['required'],
            'level' => ['required', 'string', 'max:255'],
            'school_name' => ['required', 'string', 'max:255'],
            'basic_education' => ['required', 'string', 'max:255'],
            'scholarship_honor' => ['required', 'string', 'max:255'],
            'highest_level' => ['required', 'string', 'max:255'],
            'year_graduated' => ['required', 'string', 'max:255'],
            'inclusive_dates_from' => ['required', 'date'],
            'inclusive_dates_to' => ['required', 'date'],

            //references
            'pds_id' =>['required'],
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'telephone_number' => ['required', 'string', 'max:255'],

            // //employee
            // 'first_name' => ['required', 'string'],
            // 'middle_name' => ['required', 'string'],
            // 'last_name' => ['required', 'string'],
            // 'suffix_name' => ['required', 'string'],
            // 'contact_number' => ['required', 'string'],
            // 'email_address' => ['required', 'string'],
            // 'current_position' => ['required', 'string', 'max:255'],
            // 'employment_status' => ['required', 'string', 'max:255'],
            // 'employee_status' => ['required', 'string', 'max:255'],
            // 'orientation_status' => ['required', 'string', 'max:255']
           
 

        ];
    }
}