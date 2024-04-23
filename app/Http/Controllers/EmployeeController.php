<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeePersonalRequest;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\PersonalDataSheet;
use App\Models\Employee;
use App\Models\PersonalInformation;
use App\Models\Vacancy;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EmployeeResource::collection(
            Employee::all()
        );
    }

    public function search(Request $request)
    {
        $activePage = $request->activePage;
        $status = $request->status;
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $year = $request->year;
        $filter = $request->filter;
        $orderAscending  ? $orderAscending = "asc" : $orderAscending = "desc";

        ($orderBy == null || $orderBy == "id") ? $orderBy = "employees.id" : $orderBy = $orderBy;
        $filters = $request->filters;
        if (!is_null($filters)) {
            $filters =  array_map(function ($filter) {
                if ($filter["column"] === "id") {
                    return ["positions.id", "like", "%" . $filter["value"] . "%"];
                } else {
                    return [$filter["column"], "like", "%" . $filter["value"] . "%"];
                }
            }, $filters);
        } else {
            $filters = [["positions.id", "like", "%"]];
        }

        $data = EmployeeResource::collection(
            Employee::select(
                "*"
                // "employees.id",
                // "employee_id",
                // "lgu_positions.division_id",
                // "first_name",
                // "middle_name",
                // "last_name",
                // "suffix_name",
                // "contact_number",
                // "email_address",
                // "title",
                // "item_number",
                // "employee_status"
            )
                ->with("lguPosition", "lguPosition.position", "lguPosition.position.salaryGrade", "division", "division.office")
                // ->join("lgu_positions", "lgu_positions.id", "employees.lgu_position_id")
                // ->join("positions", "positions.id", "lgu_positions.position_id")
                // ->join("divisions", "lgu_positions.division_id", "divisions.id")
                // ->join("offices", "offices.id", "divisions.office_id")
                // ->join("salary_grades", "positions.salary_grade_id", "salary_grades.id")
                // ->where($filters)
                ->skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->take(10)
                ->get()
        );
        $pages =
            Employee::select(
                "employees.id"
            )
            ->join("lgu_positions", "lgu_positions.id", "employees.lgu_position_id")
            ->join("positions", "positions.id", "lgu_positions.position_id")
            ->join("divisions", "lgu_positions.division_id", "divisions.id")
            ->join("offices", "offices.id", "divisions.office_id")
            ->join("salary_grades", "positions.salary_grade_id", "salary_grades.id")
            ->where($filters)
            ->count();

        return compact("pages", "data");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // validate input fields
        // $request->validated($request->all());

        $employeeExist = false;
        $request = [
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
            "birth_date" => "1996-04-02",
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
            "children" => [
                [
                    "number" => 1,
                    "name" => "ONE",
                    "birthday" => "2024-04-10"
                ],
                [
                    "number" => 1,
                    "name" => "TWO",
                    "birthday" => "2024-04-16"
                ]
            ],
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
                    "date_of_examination_conferment" => "2024-04-02",
                    "place_of_examination_conferment" => "Baguio City",
                    "license_number" => null,
                    "license_date_validity" => null
                ],
                [
                    "eligibility_title" => "LPT",
                    "rating" => "90.00",
                    "date_of_examination_conferment" => "2024-03-04",
                    "place_of_examination_conferment" => "BSU",
                    "license_number" => "213155456",
                    "license_date_validity" => "2025-04-03"
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

        // $employeeExist = Employee::where([["employee_id", $request->employee_id], ["first_name", $request->first_name], ["middle_name", $request->middle_name], ["last_name", $request->last_name]])->exists();

        if ($employeeExist) {
            return $this->error("", "Duplicate Entry", 400);
        } else {

            $employee = Employee::where([["employee_id", $request['employee_id']], ["first_name", $request['first_name']], ["middle_name", $request['middle_name']], ["last_name", $request['last_name']]])->first();
            if ($employee) {
                $employee->personalDataSheets()->delete();


                $delete = Employee::where([["employee_id", $request['employee_id']], ["first_name", $request['first_name']], ["middle_name", $request['middle_name']], ["last_name", $request['last_name']]])->delete();
            }


            $employee = Employee::create([
                "division_id" => $request['division_id'],
                "employee_id" => $request['employee_id'],
                "first_name" => $request['first_name'],
                "middle_name" => $request['middle_name'],
                "last_name" => $request['last_name'],
                "suffix" => $request['suffix'],
                "mobile_number" => $request['mobile_number'],
                "email_address" => $request['email_address'],
                "lgu_position_id" => $request['lgu_position_id'],
                "employment_status" => $request['employment_status'],
                "employee_status" => $request['employee_status'],
                "orientation_status" => "Completed"
            ]);


            $pds =  $employee->personalDataSheets()->create(['pds_date' => date('Y-m-d')]);

            // personal Information
            $personalnformation = $pds->personalInformation()->create(
                [
                    'birth_place' => $request['birth_place'],
                    'birth_date' => $request['birth_date'],
                    'age' => $request['age'],
                    'sex' => $request['sex'],
                    'height' => $request['height'],
                    'weight' => $request['weight'],
                    'citizenship' => $request['citizenship'],
                    'citizenship_type' => $request['citizenship_type'],
                    'country' => $request['country'],
                    'blood_type' => $request['blood_type'],
                    'civil_status' => $request['civil_status'],
                    'tin' => $request['tin'],
                    'gsis' => $request['gsis'],
                    'pagibig' => $request['pagibig'],
                    'philhealth' => $request['philhealth'],
                    'sss' => $request['sss'],
                    'residential_province' => $request['residential_province'],
                    'residential_municipality' => $request['residential_municipality'],
                    'residential_barangay' => $request['residential_barangay'],
                    'residential_house' => $request['residential_house'],
                    'residential_subdivision' => $request['residential_subdivision'],
                    'residential_street' => $request['residential_street'],
                    'residential_zipcode' => $request['residential_zipcode'],
                    'permanent_province' => $request['permanent_province'],
                    'permanent_municipality' => $request['permanent_municipality'],
                    'permanent_barangay' => $request['permanent_barangay'],
                    'permanent_house' => $request['permanent_house'],
                    'permanent_subdivision' => $request['permanent_subdivision'],
                    'permanent_street' => $request['permanent_street'],
                    'permanent_zipcode' => $request['permanent_zipcode'],
                    'telephone' => $request['telephone'],
                    'mobile_number' => $request['mobile_number'],
                    'email_address' => $request['email_address']
                ]
            );

            // Fanily background
            $familyBackground = $pds->familyBackGround()->create([
                'spouse_first_name' => $request['spouse_first_name'],
                'spouse_middle_name' => $request['spouse_middle_name'],
                'spouse_last_name' => $request['spouse_last_name'],
                'spouse_suffix' => $request['spouse_suffix'],
                'spouse_employer' => $request['spouse_employer'],
                'spouse_employer_address' => $request['spouse_employer_address'],
                'spouse_employer_telephone' => $request['spouse_employer_telephone'],
                'father_first_name' => $request['father_first_name'],
                'father_middle_name' => $request['father_middle_name'],
                'father_last_name' => $request['father_last_name'],
                'father_suffix' => $request['father_suffix'],
                'mother_first_name' => $request['mother_first_name'],
                'mother_middle_name' => $request['mother_middle_name'],
                'mother_last_name' => $request['mother_last_name'],
                'mother_suffix' => $request['mother_suffix'],
            ]);


            // insert children
            $children = array_map(function ($item) use ($familyBackground) {
                return ["name" => $item['name'], "birthday" => $item['birthday'], "family_background_id" => $familyBackground->id];
            }, $request['children']);

            $pds->childrenInformations()->createMany($children);

            // educational background
            // return $request['schools'];
            $pds->educationalBackgrounds()->createMany($request['schools']);


            // $pds->civilServiceEligibilities()->create([
            //     'personal_data_sheet_id',
            //     'eligibility_title',
            //     'rating',
            //     'date_of_examination_conferment',
            //     'place_of_examination_conferment',
            //     'license_number',
            //     'license_date_validity',
            // ]);
            // $pds->workExperiences()->create([
            //     'personal_data_sheet_id',
            //     'position_title',
            //     'office_company',
            //     'monthly_salary',
            //     'salary_grade',
            //     'status_of_appointment',
            //     'government_service',
            //     'date_from',
            //     'date_to',
            // ]);
            // $pds->voluntaryWorks()->create([
            //     'personal_data_sheet_id',
            //     'organization_name',
            //     'organization_address',
            //     'date_from',
            //     'date_to',
            //     'number_of_hours',
            //     'position_nature_of_work',
            // ]);
            // $pds->trainingPrograms()->create([
            //     'personal_data_sheet_id',
            //     'training_title',
            //     'attendance_from',
            //     'attendance_to',
            //     'number_of_hours',
            //     'training_type',
            //     'conducted_sponsored_by'
            // ]);
            // $pds->specialSkillHobies()->create([
            //     'personal_data_sheet_id',
            //     'name'
            // ]);
            // $pds->recognitions()->create([
            //     'personal_data_sheet_id',
            //     'recognition_title',
            // ]);
            // $pds->MembershipAssociations()->create([
            //     'personal_data_sheet_id',
            //     'organization'
            // ]);
            // $pds->answers()->create([
            //     'question_id',
            //     'answer',
            //     'details',
            // ]);


            // $pds->references()->create();
        }


        // return message
        return $this->success("", "Successfully Saved", 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return EmployeeResource::collection(
            Employee::where("id", $employee->id)
                ->get()
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $employee->first_name = $request->first_name;
        $employee->middle_name = $request->middle_name;
        $employee->last_name = $request->last_name;
        $employee->suffix_name = $request->suffix_name;
        $employee->contact_number = $request->contact_number;
        $employee->email_address = $request->email_address;
        $employee->current_position = $request->current_position;
        $employee->employment_status = $request->employment_status;
        $employee->employee_status = $request->employee_status;
        $employee->orientation_status = $request->orientation_status;
        $employee->save();
        return new EmployeeResource($employee);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->personalDataSheets()->delete();
        $employee->delete();
        return $this->success("", "Successfully Deleted", 200);
    }
}
