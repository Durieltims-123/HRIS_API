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
            "employee_id" => "1234568",
            "employment_status" => "Permanent",
            "division_id" => "3",
            "division" => "Provincial Governor's Office - Information Technology Services",
            "division_autosuggest" => "Provincial Governor's Office - Information Technology Services",
            "lgu_position_id" => "2",
            "lgu_position" => "Senior Stenographer to the Regional Governor - 6",
            "lgu_position_autosuggest" => "Senior Stenographer to the Regional Governor - 6",
            "employee_status" => "Active",
            "first_name" => "Duriel",
            "middle_name" => "Alutang",
            "last_name" => "Timatim",
            "suffix" => null,
            "birth_place" => "Kapangan, Benguet",
            "birth_date" => "1996-04-02T16=>00=>00.000Z",
            "age" => 26,
            "sex" => "Male",
            "height" => 1.5,
            "weight" => 75,
            "citizenship" => "Filipino",
            "citizenship_type" => null,
            "country" => null,
            "blood_type" => "B+",
            "civil_status" => "Married",
            "tin" => "123444444444",
            "gsis" => "122333333333",
            "pagibig" => "123123333333",
            "philhealth" => "123123333333",
            "sss" => "12312333333333",
            "residential_province" => "BENGUET",
            "residential_municipality" => "LA TRINIDAD (Capital)",
            "residential_barangay" => "Alapang",
            "residential_house" => "FB 075",
            "residential_subdivision" => "Some Subdivision",
            "residential_street" => "Some Street",
            "residential_zipcode" => "2601",
            "isSameAddress" => true,
            "permanent_province" => "BENGUET",
            "permanent_municipality" => "LA TRINIDAD (Capital)",
            "permanent_barangay" => "Alapang",
            "permanent_house" => "FB 075",
            "permanent_subdivision" => "Some Subdivision",
            "permanent_street" => "Some Street",
            "permanent_zipcode" => "2601",
            "telephone" => "13546355",
            "mobile_number" => "09503279274",
            "email_address" => "durieltims@gmail.com",
            "spouse_first_name" => "Someone",
            "spouse_middle_name" => "someone m_mname",
            "spouse_last_name" => "someone_lname",
            "spouse_suffix" => "Mar.",
            "spouse_occupation" => "Farming",
            "spouse_employer" => "Valley Bread",
            "spouse_employer_address" => "La Trinidad, Benguet",
            "spouse_employer_telephone" => "0123565897",
            "children" => [],
            "father_first_name" => "Fernando",
            "father_middle_name" => "Menzi",
            "father_last_name" => "Timatim",
            "father_suffix" => "Jr.",
            "mother_first_name" => "Elena",
            "mother_middle_name" => "Ipan",
            "mother_last_name" => "Alutang",
            "mother_suffix" => null,
            "schools" => [
                [
                    "level" => "Elementary",
                    "name" => "SES",
                    "degree" => null,
                    "period_from" => 2004,
                    "period_to" => 2010,
                    "highest_unit_earned" => null,
                    "year_graduated" => "2010",
                    "scholarship_academic_awards" => "Valedictorian"
                ],
                [
                    "level" => "Secondary",
                    "name" => "KNHS",
                    "degree" => null,
                    "period_from" => 2010,
                    "period_to" => 2015,
                    "highest_unit_earned" => null,
                    "year_graduated" => "2015",
                    "scholarship_academic_awards" => "Valedictorian"
                ],
                [
                    "level" => "College",
                    "name" => "BSU",
                    "degree" => "BSIT",
                    "period_from" => 2015,
                    "period_to" => 2019,
                    "highest_unit_earned" => "360",
                    "year_graduated" => "2019",
                    "scholarship_academic_awards" => "Suma Cumladaw"
                ]
            ],
            "eligibilities" => [
                [
                    "eligibility_title" => "CSC",
                    "rating" => "85.23",
                    "date_of_examination_conferment" => "2024-04-02T16=>00=>00.000Z",
                    "place_of_examination_conferment" => "Baguio City",
                    "license_number" => null,
                    "license_date_validity" => null
                ],
                [
                    "eligibility_title" => "LPT",
                    "rating" => "90.00",
                    "date_of_examination_conferment" => "2024-03-04T16=>00=>00.000Z",
                    "place_of_examination_conferment" => "BSU",
                    "license_number" => "213155456",
                    "license_date_validity" => "2025-04-03T16=>00=>00.000Z"
                ]
            ],
            "workExperiences" => [
                [
                    "date_from" => "2024-04-09",
                    "date_to" => "2024-04-19",
                    "position_title" => "Paralegal",
                    "office_company" => "NGO",
                    "monthly_salary" => 19232,
                    "salary_grade" => "SG 11",
                    "status_of_appointment" => "Casual",
                    "government_service" => "No"
                ]
            ],
            "voluntaryWorks" => [
                [
                    "organization_name" => "NGO",
                    "organization_address" => "NGO address",
                    "number_of_hours" => 32,
                    "position_nature_of_work" => "Some Postition",
                    "date_from" => "2024-04-03",
                    "date_to" => "2024-04-17"
                ]
            ],
            "trainings" => [
                [
                    "training_title" => "DICT Training",
                    "attendance_from" => "2024-04-02",
                    "attendance_to" => "2024-04-04",
                    "number_of_hours" => 24,
                    "training_type" => "Managerial",
                    "conducted_sponsored_by" => "DICT"
                ]
            ],
            "skills" => [
                [
                    "special_skill" => "Painting"
                ]
            ],
            "recognitions" => [
                [
                    "recognition_title" => "BIYAG"
                ]
            ],
            "memberships" => [
                [
                    "organization" => "Eagle"
                ]
            ],
            "answers" => [
                [
                    "id" => "1",
                    "number" => "34a",
                    "question" => "Are you related by consanguinity or affinity to the appointing or recommending authority, or to the\t\t\t\n                            chief of bureau or division or to the person who has immediate supervision over you in the Division, \t\t\t\n                            Bureau or Office where you will be apppointed,\t\t\t\n                            a. within the third degree?",
                    "answer" => null,
                    "details" => null
                ],
                [
                    "id" => "2",
                    "number" => "34b",
                    "question" => "b. within the fourth degree (for Local Government Unit - Career Employees)?",
                    "answer" => null,
                    "details" => null
                ],
                [
                    "id" => "3",
                    "number" => "35a",
                    "question" => "a. Have you ever been found guilty of any administrative offense?",
                    "answer" => null,
                    "details" => null
                ],
                [
                    "id" => "4",
                    "number" => "35b",
                    "question" => "b. Have you been criminally charged before any court?",
                    "answer" => null,
                    "details" => null
                ],
                [
                    "id" => "5",
                    "number" => "36",
                    "question" => "Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?",
                    "answer" => null,
                    "details" => null
                ],
                [
                    "id" => "6",
                    "number" => "37",
                    "question" => "Have you ever been separated from the service in any of the following modes=> resignation, retirement, dropped from the rolls, dismissal, termination, end of term, finished contract or phased out (abolition) in the public or private sector?",
                    "answer" => null,
                    "details" => null
                ],
                [
                    "id" => "7",
                    "number" => "38a",
                    "question" => "a. Have you ever been a candidate in a national or local election held within the last year (except Barangay election)?",
                    "answer" => null,
                    "details" => null
                ],
                [
                    "id" => "8",
                    "number" => "38b",
                    "question" => "b. Have you resigned from the government service during the three (3)-month period before the last election to promote/actively campaign for a national or local candidate?",
                    "answer" => null,
                    "details" => null
                ],
                [
                    "id" => "9",
                    "number" => "39",
                    "question" => "Have you acquired the status of an immigrant or permanent resident of another country?",
                    "answer" => null,
                    "details" => null
                ],
                [
                    "id" => "10",
                    "number" => "40a",
                    "question" => "Pursuant to=> (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons (RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items=>\n                                a. Are you a member of any indigenous group?",
                    "answer" => null,
                    "details" => null
                ],
                [
                    "id" => "11",
                    "number" => "40b",
                    "question" => "Are you a person with disability?",
                    "answer" => null,
                    "details" => null
                ],
                [
                    "id" => "12",
                    "number" => "40c",
                    "question" => "Are you a solo parent?",
                    "answer" => null,
                    "details" => null
                ]
            ],
            "characterReferences" => [
                [
                    "name" => "Name1",
                    "address" => "Address1",
                    "number" => "02132432453"
                ],
                [
                    "name" => "Name2",
                    "address" => "Address2",
                    "number" => "02132432453"
                ],
                [
                    "name" => "Name3",
                    "address" => "Address3",
                    "number" => "02132432453"
                ]
            ]
        ];

        $employeeCheck = [
            "division_id" => "3",
            "employee_id" => "1234568",
            "first_name" => "Duriel",
            "middle_name" => "Alutang",
            "last_name" => "Timatim",
            "suffix" => null,
            "mobile_number" => "09503279274",
            "email_address" => "durieltims@gmail.com",
            "lgu_position_id" => "2",
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

    // delete 
    // public function test_delete_employee(): void
    // {

    //     $employeeCheck = [
    //         "division_id" => "3",
    //         "employee_id" => "1234568",
    //         "first_name" => "Duriel",
    //         "middle_name" => "Alutang",
    //         "last_name" => "Timatim",
    //         "suffix" => null,
    //         "mobile_number" => "09503279274",
    //         "email_address" => "durieltims@gmail.com",
    //         "lgu_position_id" => "2",
    //         "employment_status" => "Permanent",
    //         "employee_status" => "Active"
    //     ];

    //     $data = Employee::where($employeeCheck)->first();
    //     $user = User::factory()->create();
    //     $this->assertCount(0, $user->tokens);
    //     $this->actingAs($user);
    //     $this->delete("/api/employee/" . $data->id);
    //     $response = $this->assertDatabaseMissing("employees", $employeeCheck);
    // }
}
