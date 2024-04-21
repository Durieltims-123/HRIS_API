<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\employee;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class employeeTest extends TestCase
{
    // link
    public function test_employee_link(): void
    {
        $response = $this->get("/");
        $response->assertStatus(200);
    }

    // index
    public function test_employee_index(): void
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $response = $this->get("/api/employee");
        $response->assertStatus(200);
    }

    // add
    public function test_add_employee(): void
    {
        $formData = [
            "employee_id"  => "123456",
            "employment_status" =>  "Permanent",
            "division_id" =>  1,
            "division" =>  "Division Test",
            "division_autosuggest" =>  "Division Test",
            "lgu_position_id" => 1,
            "lgu_position" => "Position Test",
            "lgu_position_autosuggest" => "Position Test",
            "employee_status" => "Active",
            "first_name" =>  "Duriel",
            "middle_name" =>  "Alutang",
            "last_name" =>  "Timatim",
            "suffix" =>  null,
            "birth_place" =>  "",
            "birth_date" =>  "",
            "age" => "",
            "sex" =>  "",
            "height" => "",
            "weight" =>  "",
            "citizenship" =>  "",
            "citizenship_type" =>  "",
            "country" =>   "",
            "blood_type" =>  "",
            "civil_status" =>  "",
            "tin" =>  "",
            "gsis" =>  "",
            "pagibig" => "",
            "philhealth" => "",
            "sss" =>  "",
            "residential_province" =>  "",
            "residential_municipality" =>  "",
            "residential_barangay" =>  "",
            "residential_house" =>  "",
            "residential_subdivision" =>  "",
            "residential_street" =>  "",
            "residential_zipcode" =>  "",
            "permanent_province" =>  "",
            "permanent_municipality" =>  "",
            "permanent_barangay" =>  "",
            "permanent_house" =>  "",
            "permanent_subdivision" =>  "",
            "permanent_street" =>  "",
            "permanent_zipcode" =>  "",
            "telephone" =>  "",
            "mobile_number" => "09503279274",
            "email_address" =>  "durieltims@gmail.com",


            "spouse_first_name" =>  "",
            "spouse_middle_name" =>  "",
            "spouse_last_name" =>  "",
            "spouse_suffix" =>  "",
            "spouse_occupation" =>  "",
            "spouse_employer" =>  "",
            "spouse_employer_address" => "",
            "spouse_employer_telephone" => "",


            "children.*.name" => "",
            "children.*.birthday" => "",


            "father_first_name" =>  "",
            "father_middle_name" =>  "",
            "father_last_name" =>  "",
            "father_suffix" =>  "",
            "mother_first_name" =>  "",
            "mother_middle_name" =>  "",
            "mother_last_name" =>  "",
            "mother_suffix" =>  "",


            "schools.*.level" => "",
            "schools.*.name" => "",
            "schools.*.degree" => "",
            "schools.*.period_from" => "",
            "schools.*.period_to" => "",
            "schools.*.highest_unit_earned" => "",
            "schools.*.year_graduated" => "",
            "schools.*.scholarship_academic_awards" => "",

            "eligibilities.*.eligibility_title" => "",
            "eligibilities.*.rating" => "",
            "eligibilities.*.date_of_examination_conferment" => "",
            "eligibilities.*.place_of_examination_conferment" => "",
            "eligibilities.*.license_number" => "",
            "eligibilities.*.license_date_validity" => "",

            "workExperiences.*.date_from" => "",
            "workExperiences.*.date_to" => "",
            "workExperiences.*.position_title" => "",
            "workExperiences.*.office_company" => "",
            "workExperiences.*.monthly_salary" => "",
            "workExperiences.*.salary_grade" => "",
            "workExperiences.*.status_of_appointment" => "",
            "workExperiences.*.government_service" => "",

            "voluntaryWorks.*.organization_name" => "",
            "voluntaryWorks.*.organization_address" => "",
            "voluntaryWorks.*.date_from" => "",
            "voluntaryWorks.*.date_to" => "",
            "voluntaryWorks.*.number_of_hours" => "",
            "voluntaryWorks.*.position_nature_of_work" => "",

            "trainings.*.training_title" => "",
            "trainings.*.attendance_from" => "",
            "trainings.*.attendance_to" => "",
            "trainings.*.number_of_hours" => "",
            "trainings.*.training_type" => "",
            "trainings.*.conducted_sponsored_by" => "",

            "skills.*.special_skill" =>  "",
            "recognitions.*.recognition_title" =>  "",
            "memberships.*.title" =>  "",

            "characterReferences.*.name" =>  "",
            "characterReferences.*.address" =>  "",
            "characterReferences.*.number" =>  "",

            "answers.*.details" =>  "",

        ];

        $employeeCheck = [
            "division_id" => 1,
            "employee_id"  => "123456",
            "first_name" => "Duriel",
            "middle_name" => "Alutang",
            "last_name" => "Timatim",
            "suffix" => null,
            "mobile_number" => "09503279274",
            "email_address" => "durieltims@gmail.com",
            "lgu_position_id" => 1,
            "employment_status" => "Permanent",
            "employee_status" => "Active"
        ];



        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
        $this->actingAs($user);
        $this->post("/api/employee", $formData);

        // this will check if it is inserted in the database
        $response = $this->assertDatabaseHas("employees", $employeeCheck);
    }



    // edit 
    // public function test_edit_employee(): void
    // {
    //     $formData = [
    //         "division_id" => 2,
    //         "first_name" => "Edited aw",
    //         "middle_name" => "Edited2",
    //         "last_name" => "aw",
    //         "suffix_name" => "aw",
    //         "contact_number" => "aw",
    //         "email_address" => "aw",
    //         "current_position" => "aw",
    //         "employment_status" => "aw",
    //         "employee_status" => "aw",
    //         "orientation_status" => "aw",
    //     ];
    //     $sg = Employee::where([["first_name", "First name test"], ["middle_name", "aw"]])->first();

    //     $user = User::factory()->create();
    //     $this->assertCount(0, $user->tokens);
    //     $this->actingAs($user);
    //     $this->patch("/api/employee/" . $sg->id, $formData);

    //     // this check if it updated in the database 
    //     $response = $this->assertDatabaseHas("employees", $formData);
    // }

    // // delete 
    // public function test_delete_employee(): void
    // {
    //     $formData = [
    //         "division_id" => 2,
    //         "first_name" => "Edited aw",
    //         "middle_name" => "Edited2",
    //         "last_name" => "aw",
    //         "suffix_name" => "aw",
    //         "contact_number" => "aw",
    //         "email_address" => "aw",
    //         "current_position" => "aw",
    //         "employment_status" => "aw",
    //         "employee_status" => "aw",
    //         "orientation_status" => "aw",
    //     ];
    //     $sg = Employee::where([["first_name", "Edited aw"], ["middle_name", "Edited2"]])->first();
    //     $user = User::factory()->create();
    //     $this->assertCount(0, $user->tokens);
    //     $this->actingAs($user);
    //     $this->delete("/api/employee/" . $sg->id);
    //     $response = $this->assertDatabaseMissing("employees", $formData);
    // }
}
