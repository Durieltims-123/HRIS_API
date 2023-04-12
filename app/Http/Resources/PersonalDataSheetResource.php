<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonalDataSheetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => (string)$this->id,
            "attributes" => [

                // pds
                "applicant_id" => (string)$this->applicant_id,
                "employee_id" => (string)$this->employee_id,

                // $mobile_number = optional($this->hasManyPersonalInformation->first())->mobile_number;
                // personal information
                "personal_data_sheet_id" => (string)$this->hasManyPersonalInformation[0]->personal_data_sheet_id,
                // "mobile_number" => (string)$this->mobile_number,
                "mobile_number" => (string)$this->hasManyPersonalInformation[0]->mobile_number,
                "telephone_number" => (string)$this->hasManyPersonalInformation[0]->telephone_number,
                "permanent_house_number" => (string)$this->hasManyPersonalInformation[0]->permanent_house_number,
                "permanent_subdivision_village" => (string)$this->hasManyPersonalInformation[0]->permanent_subdivision_village,
                "permanent_street" => (string)$this->hasManyPersonalInformation[0]->permanent_street,

                "barangay_id" => (string)$this->hasManyPersonalInformation[0]->barangay_id,
                "municipality_id" => (string)$this->hasManyPersonalInformation[0]->municipality_id,
                "province_id" => (string)$this->hasManyPersonalInformation[0]->province_id,                

                "permanent_zip_code_number" => (string)$this->hasManyPersonalInformation[0]->permanent_zip_code_number,
                "residential_house_number" => (string)$this->hasManyPersonalInformation[0]->residential_house_number,
                "residential_subdivision_village" => (string)$this->hasManyPersonalInformation[0]->residential_subdivision_village,
                "residential_street" => (string)$this->hasManyPersonalInformation[0]->residential_street,

                "r_barangay_id" => (string)$this->hasManyPersonalInformation[0]->r_barangay_id,
                "r_municipality_id" => (string)$this->hasManyPersonalInformation[0]->r_municipality_id,
                "r_province_id" => (string)$this->hasManyPersonalInformation[0]->r_province_id,

                "residential_zip_code_number" => (string)$this->hasManyPersonalInformation[0]->residential_zip_code_number,
                "citizenship" => (string)$this->hasManyPersonalInformation[0]->citizenship,
                "agency_employee" => (string)$this->hasManyPersonalInformation[0]->agency_employee,
                "tin_number" => (string)$this->hasManyPersonalInformation[0]->tin_number,
                "sss_number" => (string)$this->hasManyPersonalInformation[0]->sss_number,
                "philhealth_number" => (string)$this->hasManyPersonalInformation[0]->philhealth_number,
                "pag_ibig_number" => (string)$this->hasManyPersonalInformation[0]->pag_ibig_number,
                "gsis_number" => (string)$this->hasManyPersonalInformation[0]->gsis_number,
                "blood_type" => (string)$this->hasManyPersonalInformation[0]->blood_type,
                "weight" => (string)$this->hasManyPersonalInformation[0]->weight,
                "height" => (string)$this->hasManyPersonalInformation[0]->height,
                "civil_status" => (string)$this->hasManyPersonalInformation[0]->civil_status,
                "sex" => (string)$this->hasManyPersonalInformation[0]->sex,
                "birthplace" => (string)$this->hasManyPersonalInformation[0]->birthplace,
                "birthdate" => (string)$this->hasManyPersonalInformation[0]->birthdate,

                //family background & children information
                "spouse_surname" => (string)$this->hasManyFamilyBackground[0]->spouse_surname,
                "spouse_first_name" => (string)$this->hasManyFamilyBackground[0]->spouse_first_name,
                "spouse_middle_name" => (string)$this->hasManyFamilyBackground[0]->spouse_middle_name,
                "suffix_name" => (string)$this->hasManyFamilyBackground[0]->suffix_name,
                "occupation" => (string)$this->hasManyFamilyBackground[0]->occupation,
                "employee_business_name" => (string)$this->hasManyFamilyBackground[0]->employee_business_name,
                "business_address" => (string)$this->hasManyFamilyBackground[0]->business_address,
                "telephone_number" => (string)$this->hasManyFamilyBackground[0]->telephone_number,
                "father_surname" => (string)$this->hasManyFamilyBackground[0]->father_surname,
                "father_first_name" => (string)$this->hasManyFamilyBackground[0]->father_first_name,
                "father_middle_name" => (string)$this->hasManyFamilyBackground[0]->father_middle_name,
                "father_extension_name" => (string)$this->hasManyFamilyBackground[0]->father_extension_name,
                "mother_maiden_surname" => (string)$this->hasManyFamilyBackground[0]->mother_maiden_surname,
                "mother_first_name" => (string)$this->hasManyFamilyBackground[0]->mother_first_name,
                "mother_maiden_middle_name" => (string)$this->hasManyFamilyBackground[0]->mother_maiden_middle_name,
                'children' => $this->hasManyChildrenInformation->map(function ($children_info) {
                    return [
                        'family_background_id' => $children_info->family_background_id,
                        'children_name' => $children_info->children_name,
                        'children_birthdate' => $children_info->children_birthdate,
                    ];
                }),

                //educational background
                "level" => (string)$this->hasManyEducationalBackground[0]->level,
                "school_name" => (string)$this->hasManyEducationalBackground[0]->school_name,
                "basic_education" => (string)$this->hasManyEducationalBackground[0]->basic_education,
                "scholarship_honor" => (string)$this->hasManyEducationalBackground[0]->scholarship_honor,
                "highest_level" => (string)$this->hasManyEducationalBackground[0]->highest_level,
                "year_graduated" => (string)$this->hasManyEducationalBackground[0]->year_graduated,
                "eb_inclusive_dates_from" => (string)$this->hasManyEducationalBackground[0]->eb_inclusive_dates_from,
                "eb_inclusive_dates_to" => (string)$this->hasManyEducationalBackground[0]->eb_inclusive_dates_to,

                //civil service eligibility
                'civilServiceEligibility' => $this->hasManyCivilServiceEligibility->map(function ($civilServiceEligibility) {
                    return [
                        'career_service' => $civilServiceEligibility->career_service,
                        'rating' => $civilServiceEligibility->rating,
                        'examination_date' => $civilServiceEligibility->examination_date,
                        'place_examination' => $civilServiceEligibility->place_examination,
                        'license_number' => $civilServiceEligibility->license_number,
                        'date_validity' => $civilServiceEligibility->date_validity,
                    ];
                }),

                //work experience
                'workExperience' => $this->hasManyWorkExperience->map(function ($workExpererience) {
                    return [
                        'position_title' => $workExpererience->position_title,
                        'department' => $workExpererience->department,
                        'monthly_salary' => $workExpererience->monthly_salary,
                        'salary' => $workExpererience->salary,
                        'status_appointment' => $workExpererience->status_appointment,
                        'government_service' => $workExpererience->government_service,
                        'inclusive_dates_from' => $workExpererience->inclusive_dates_from,
                        'inclusive_dates_to' => $workExpererience->inclusive_dates_to,
                    ];
                }),

                //voluntary work
                'voluntaryWork' => $this->hasManyVoluntaryWork->map(function ($voluntaryWork) {
                    return [
                        'organization_name' => $voluntaryWork->organization_name,
                        'organization_address' => $voluntaryWork->organization_address,
                        'position' => $voluntaryWork->position,
                        'number_hours' => $voluntaryWork->number_hours,
                        'vw_inclusive_dates_from' => $voluntaryWork->vw_inclusive_dates_from,
                        'vw_inclusive_dates_to' => $voluntaryWork->vw_inclusive_dates_to,
                    ];
                }),

                //training program attended
                'trainingProgramAttended' => $this->hasManyTrainingProgramAttended->map(function ($trainingProgramAttended) {
                    return [
                        'program_title' => $trainingProgramAttended->program_title,
                        'hours' => $trainingProgramAttended->hours,
                        'type' => $trainingProgramAttended->type,
                        'conducted_by' => $trainingProgramAttended->conducted_by,
                        'tp_inclusive_dates_from' => $trainingProgramAttended->tp_inclusive_dates_from,
                        'tp_inclusive_dates_to' => $trainingProgramAttended->tp_inclusive_dates_to,
                    ];
                }),

                //special skills
                'specialSkills' => $this->hasManySpecialSkillHobby->map(function ($specialSkills) {
                    return [
                        'special_skills' => $specialSkills->special_skills,
                    ];
                }),

                //recognition
                'rocognition' => $this->hasManyRecognition->map(function ($rocognition) {
                    return [
                        'recognition_title' => $rocognition->recognition_title,
                    ];
                }),

                //membership association
                'membershipAssociation' => $this->hasManyMembershipAssociation->map(function ($membershipAssociation) {
                    return [
                        'membership_association' => $membershipAssociation->membership_association,
                    ];
                }),

                //answer
                'answer' => $this->hasManyAnswer->map(function ($answer) {
                    return [
                        'choice' => $answer->choice,
                        'details' => $answer->details,
                        'date_filed' => $answer->date_filed,
                        'case_status' => $answer->case_status,
                    ];
                }),

                //reference
                "name" => (string)$this->hasManyReference[0]->name,
                "address" => (string)$this->hasManyReference[0]->address,
                "telephone_number" => (string)$this->hasManyReference[0]->telephone_number,
                "name2" => (string)$this->hasManyReference[0]->name2,
                "address2" => (string)$this->hasManyReference[0]->address2,
                "telephone_number2" => (string)$this->hasManyReference[0]->telephone_number2,
                "name3" => (string)$this->hasManyReference[0]->name3,
                "address3" => (string)$this->hasManyReference[0]->address3,
                "telephone_number3" => (string)$this->hasManyReference[0]->telephone_number3,

            ],

        ];
    }
}
