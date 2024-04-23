<?php

namespace Tests\Feature;

use App\Models\Applicant;
use App\Models\PersonalDataSheet;
use App\Models\PersonalInformation;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PersonalDataSheetTest extends TestCase
{
// link
public function test_personal_data_sheet_link(): void
{
    $response = $this->get('/');
    $response->assertStatus(200);
}

// index
public function test_personal_data_sheet_index(): void
{
    $user = User::factory()->create();
    $this->assertCount(0, $user->tokens);
    $this->actingAs($user);
    $response = $this->get('/api/personal-data-sheet');
    $response->assertStatus(200);
}

// add
public function test_add_personal_data_sheet(): void
{

$applicant = Applicant::first();

    $formData = [
        'applicant_id' => $applicant,
        'employee_id' => null,

        //personal information
        'personal_data_sheet_id' => 1,
        'mobile_number' => "aw",
        'telephone_number' => "aw",
        'permanent_house_number' => "aw",
        'permanent_subdivision_village' => "aw",
        'permanent_street' => "aw",
        'barangay_id' => 1,
        'municipality_id' => 1,
        'province_id' => 1,
        'permanent_zip_code' => "aw",
        'residential_house_number' => "aw",
        'residential_subdivision_village' => "aw",
        'residential_street' => "aw",
        'r_barangay_id' => 1,
        'r_municipality_id' => 1,
        'r_province_id' => 1,
        'residential_zip_code' => "aw",
        'citizenship' => "aw",
        'agency_employee' => "aw",
        'tin_number' => "aw",
        'sss_number' => "aw",
        'philhealth_number' => "aw",
        'pag_ibig_number' => "aw",
        'gsis_number' => "aw",
        'blood_type' => "aw",
        'weight' => "aw",
        'height' => "aw",
        'civil_status' => "aw",
        'sex' => "aw",
        'birthplace' => "aw",
        'birth_date' => "2020-10-10",


        //family background
        'personal_data_sheet_id' => 1,
        'spouse_surname' => "aw",
        'spouse_first_name' => "aw",
        'spouse_middle_name' => "aw",
        'suffix_name' => "aw",
        'occupation' => "aw",
        'employee_business_name' => "aw",
        'business_address' => "aw",
        'telephone_number' => "aw",
        'father_surname' => "aw",
        'father_first_name' => "aw",
        'father_middle_name' => "aw",
        'father_extension_name' => "aw",
        'mother_maiden_surname' => "aw",
        'mother_first_name' => "aw",
        'mother_maiden_middle_name' => "aw",

        //children information
        'personal_data_sheet_id' => 1,
        'family_background_id' => 1,
        'children_name' => ["maga"],
        'children_birthdate' => ["2020-10-10"],

        //educational background
        'personal_data_sheet_id' => 1,
        'level' => "aw",
        'school_name' => "aw",
        'basic_education' => "aw",
        'scholarship_honor' => "aw",
        'highest_level' => "aw",
        'year_graduated' => "aw",
        'eb_inclusive_dates_from' => "2020-10-10",
        'eb_inclusive_dates_to' => "2020-10-10",

        //civil sercvice eligibility
        'personal_data_sheet_id' => 1,
        'career_service' => ["maga"],
        'rating' => ["maga"],
        'examination_date' => ["2020-10-10"],
        'place_examination' => ["maga"],
        'license_number' => ["maga"],
        'date_validity' => ["2020-10-10"],

        //work experience
        'personal_data_sheet_id' => 1,
        'position_title' => ["maga"],
        'office' => ["maga"],
        'monthly_salary' => ["maga"],
        'salary' => ["maga"],
        'status_appointment' => ["maga"],
        'government_service' => ["maga"],
        'inclusive_dates_from' => ["2020-10-10"],
        'inclusive_dates_to' => ["2020-10-10"],

        //vountary work
        'personal_data_sheet_id' => 1,
        'organization_name' => ["maga"],
        'organization_address' => ["maga"],
        'position' => ["maga"],
        'number_hours' => ["maga"],
        'vw_inclusive_dates_from' => ["2020-10-10"],
        'vw_inclusive_dates_to' => ["2020-10-10"],

        //training program attended
        'personal_data_sheet_id' => 1,
        'program_title' => ["maga"],
        'hours' => ["maga"],
        'type' => ["maga"],
        'conducted_by' => ["maga"],
        'tp_inclusive_dates_from' => ["2020-10-10"],
        'tp_inclusive_dates_to' => ["2020-10-10"],
    
        //special skills
        'personal_data_sheet_id' => 1,
        'special_skills' => ["maga"],

        //recognition
        'personal_data_sheet_id' => 1,
        'recognition_title' => ["maga"],

        //membership association
        'personal_data_sheet_id' => 1,
        'membership_association' => ["maga"],

        //answer
        'personal_data_sheet_id' => 1,
        'question_id' => 1,
        'choice' => ["Yes"],
        'details' => ["maga"],
        'date_filed' => ["maga"],
        'case_status' => ["maga"],

        //references
        'personal_data_sheet_id' => 1,
        'name' => "aw",
        'address' => "aw",
        'telephone_number' => "aw",
        'name2' => "aw",
        'address2' => "aw",
        'telephone_number2' => "aw",
        'name3' => "aw",
        'address3' => "aw",
        'telephone_number3' => "aw",
    ];
    $pdsData=[
        'applicant_id' => $applicant->id,
        'employee_id' => null,
    ];

    $user = User::factory()->create();
    $this->assertCount(0, $user->tokens);
    $this->actingAs($user);
    $this->post('/api/personal-data-sheet', $formData);

    // this will check if it is inserted in the database
    $response = $this->assertDatabaseHas('personal_data_sheets', $pdsData);
}



// edit 
public function test_edit_personal_data_sheet(): void
{
    $formData = [
        'applicant_id' => 1,
        'employee_id' => null,

        //personal information
        'personal_data_sheet_id' => 1,
        'mobile_number' => "aw edited",
        'telephone_number' => "aw",
        'permanent_house_number' => "aw",
        'permanent_subdivision_village' => "aw",
        'permanent_street' => "aw",
        'barangay_id' => 1,
        'municipality_id' => 1,
        'province_id' => 1,
        'permanent_zip_code' => "aw",
        'residential_house_number' => "aw",
        'residential_subdivision_village' => "aw",
        'residential_street' => "aw",
        'r_barangay_id' => 1,
        'r_municipality_id' => 1,
        'r_province_id' => 1,
        'residential_zip_code' => "aw",
        'citizenship' => "aw",
        'agency_employee' => "aw",
        'tin_number' => "aw",
        'sss_number' => "aw",
        'philhealth_number' => "aw",
        'pag_ibig_number' => "aw",
        'gsis_number' => "aw",
        'blood_type' => "aw",
        'weight' => "aw",
        'height' => "aw",
        'civil_status' => "aw",
        'sex' => "aw",
        'birthplace' => "aw",
        'birth_date' => "2020-10-10",


        //family background
        'personal_data_sheet_id' => 1,
        'spouse_surname' => "aw",
        'spouse_first_name' => "aw",
        'spouse_middle_name' => "aw",
        'suffix_name' => "aw",
        'occupation' => "aw",
        'employee_business_name' => "aw",
        'business_address' => "aw",
        'telephone_number' => "aw",
        'father_surname' => "aw",
        'father_first_name' => "aw",
        'father_middle_name' => "aw",
        'father_extension_name' => "aw",
        'mother_maiden_surname' => "aw",
        'mother_first_name' => "aw",
        'mother_maiden_middle_name' => "aw",

        //children information
        'personal_data_sheet_id' => 1,
        'family_background_id' => 1,
        'children_name' => ["maga"],
        'children_birthdate' => ["2020-10-10"],

        //educational background
        'personal_data_sheet_id' => 1,
        'level' => "aw",
        'school_name' => "aw",
        'basic_education' => "aw",
        'scholarship_honor' => "aw",
        'highest_level' => "aw",
        'year_graduated' => "aw",
        'eb_inclusive_dates_from' => "2020-10-10",
        'eb_inclusive_dates_to' => "2020-10-10",

        //civil sercvice eligibility
        'personal_data_sheet_id' => 1,
        'career_service' => ["maga"],
        'rating' => ["maga"],
        'examination_date' => ["2020-10-10"],
        'place_examination' => ["maga"],
        'license_number' => ["maga"],
        'date_validity' => ["2020-10-10"],

        //work experience
        'personal_data_sheet_id' => 1,
        'position_title' => ["maga"],
        'office' => ["maga"],
        'monthly_salary' => ["maga"],
        'salary' => ["maga"],
        'status_appointment' => ["maga"],
        'government_service' => ["maga"],
        'inclusive_dates_from' => ["2020-10-10"],
        'inclusive_dates_to' => ["2020-10-10"],

        //vountary work
        'personal_data_sheet_id' => 1,
        'organization_name' => ["maga"],
        'organization_address' => ["maga"],
        'position' => ["maga"],
        'number_hours' => ["maga"],
        'vw_inclusive_dates_from' => ["2020-10-10"],
        'vw_inclusive_dates_to' => ["2020-10-10"],

        //training program attended
        'personal_data_sheet_id' => 1,
        'program_title' => ["maga"],
        'hours' => ["maga"],
        'type' => ["maga"],
        'conducted_by' => ["maga"],
        'tp_inclusive_dates_from' => ["2020-10-10"],
        'tp_inclusive_dates_to' => ["2020-10-10"],
    
        //special skills
        'personal_data_sheet_id' => 1,
        'special_skills' => ["maga"],

        //recognition
        'personal_data_sheet_id' => 1,
        'recognition_title' => ["maga"],

        //membership association
        'personal_data_sheet_id' => 1,
        'membership_association' => ["maga"],

        //answer
        'personal_data_sheet_id' => 1,
        'question_id' => 1,
        'choice' => ["Yes"],
        'details' => ["maga"],
        'date_filed' => ["maga"],
        'case_status' => ["maga"],

        //references
        'personal_data_sheet_id' => 1,
        'name' => "aw",
        'address' => "aw",
        'telephone_number' => "aw",
        'name2' => "aw",
        'address2' => "aw",
        'telephone_number2' => "aw",
        'name3' => "aw",
        'address3' => "aw",
        'telephone_number3' => "aw",
    ];

    $pdsData=[
        'applicant_id' => 1,
        'employee_id' => null,
    ];

    $sg = PersonalDataSheet::where([["applicant_id", 1], ["employee_id", null]])->first();

    $user = User::factory()->create();
    $this->assertCount(0, $user->tokens);
    $this->actingAs($user);
    $this->patch('/api/personal-data-sheet/' . $sg->id, $formData);

    // this check if it updated in the database 
    $response = $this->assertDatabaseHas('personal_data_sheets', $pdsData);
}

// delete 
public function test_delete_personal_data_sheet(): void
{
    $pds = PersonalDataSheet::latest('id')->first();
    $formData = [
        'applicant_id' => $pds->applicant_id,
        'employee_id' => $pds->employee_id,
    ];
    
    $user = User::factory()->create();
    $this->assertCount(0, $user->tokens);
    $this->actingAs($user);
    $this->delete('/api/personal-data-sheet/' . $pds->id);
    $response = $this->assertDatabaseMissing('personal_data_sheets', $formData);
}
}
