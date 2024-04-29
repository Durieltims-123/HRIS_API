<?php

namespace App\Http\Controllers;

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
                    return ["employees.id", "like", "%" . $filter["value"] . "%"];
                } else {
                    return [$filter["column"], "like", "%" . $filter["value"] . "%"];
                }
            }, $filters);
        } else {
            $filters = [["employees.id", "like", "%"]];
        }

        $data = EmployeeResource::collection(
            Employee::select(
                "*",
                "employees.id  as id",
                "employee_id",
                "lgu_positions.division_id",
                "first_name",
                "middle_name",
                "last_name",
                "suffix",
                "mobile_number",
                "email_address",
                "title",
                "item_number",
                "employee_status"
            )
                ->join("lgu_positions", "lgu_positions.id", "employees.lgu_position_id")
                ->join("positions", "positions.id", "lgu_positions.position_id")
                ->join("divisions", "lgu_positions.division_id", "divisions.id")
                ->join("offices", "offices.id", "divisions.office_id")
                ->join("salary_grades", "positions.salary_grade_id", "salary_grades.id")
                ->where($filters)
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
    public function store(StoreEmployeeRequest $request)
    {
        // validate input fields
        $request->validated($request->all());

        $employeeExist = Employee::where([["employee_id", $request->employee_id], ["first_name", $request->first_name], ["middle_name", $request->middle_name], ["last_name", $request->last_name]])->exists();

        if ($employeeExist) {
            return $this->error("", "Duplicate Entry", 400);
        } else {

            $employee = Employee::where([["employee_id", $request->employee_id], ["first_name", $request->first_name], ["middle_name", $request->middle_name], ["last_name", $request->last_name]])->first();
            if ($employee) {
                $employee->personalDataSheets()->delete();


                $delete = Employee::where([["employee_id", $request->employee_id], ["first_name", $request->first_name], ["middle_name", $request->middle_name], ["last_name", $request->last_name]])->delete();
            }

            // create employee

            $employee = Employee::create([
                "division_id" => $request->division_id,
                "employee_id" => $request->employee_id,
                "first_name" => $request->first_name,
                "middle_name" => $request->middle_name,
                "last_name" => $request->last_name,
                "suffix" => $request->suffix,
                "mobile_number" => $request->mobile_number,
                "email_address" => $request->email_address,
                "lgu_position_id" => $request->lgu_position_id,
                "employment_status" => $request->employment_status,
                "employee_status" => $request->employee_status,
                "orientation_status" => "Completed"
            ]);


            $pds =  $employee->personalDataSheets()->create(['pds_date' => date('Y-m-d')]);

            // personal Information
            $personalnformation = $pds->personalInformation()->create(
                [
                    'birth_place' => $request->birth_place,
                    'birth_date' => $request->birth_date,
                    'age' => $request->age,
                    'sex' => $request->sex,
                    'height' => $request->height,
                    'weight' => $request->weight,
                    'citizenship' => $request->citizenship,
                    'citizenship_type' => $request->citizenship_type,
                    'country' => $request->country,
                    'blood_type' => $request->blood_type,
                    'civil_status' => $request->civil_status,
                    'tin' => $request->tin,
                    'gsis' => $request->gsis,
                    'pagibig' => $request->pagibig,
                    'philhealth' => $request->philhealth,
                    'sss' => $request->sss,
                    'residential_province' => $request->residential_province,
                    'residential_municipality' => $request->residential_municipality,
                    'residential_barangay' => $request->residential_barangay,
                    'residential_house' => $request->residential_house,
                    'residential_subdivision' => $request->residential_subdivision,
                    'residential_street' => $request->residential_street,
                    'residential_zipcode' => $request->residential_zipcode,
                    'permanent_province' => $request->permanent_province,
                    'permanent_municipality' => $request->permanent_municipality,
                    'permanent_barangay' => $request->permanent_barangay,
                    'permanent_house' => $request->permanent_house,
                    'permanent_subdivision' => $request->permanent_subdivision,
                    'permanent_street' => $request->permanent_street,
                    'permanent_zipcode' => $request->permanent_zipcode,
                    'telephone' => $request->telephone,
                    'mobile_number' => $request->mobile_number,
                    'email_address' => $request->email_address
                ]
            );

            // Family background
            $familyBackground = $pds->familyBackGround()->create([
                'spouse_first_name' => $request->spouse_first_name,
                'spouse_middle_name' => $request->spouse_middle_name,
                'spouse_last_name' => $request->spouse_last_name,
                'spouse_suffix' => $request->spouse_suffix,
                'spouse_occupation' => $request->spouse_occupation,
                'spouse_employer' => $request->spouse_employer,
                'spouse_employer_address' => $request->spouse_employer_address,
                'spouse_employer_telephone' => $request->spouse_employer_telephone,
                'father_first_name' => $request->father_first_name,
                'father_middle_name' => $request->father_middle_name,
                'father_last_name' => $request->father_last_name,
                'father_suffix' => $request->father_suffix,
                'mother_first_name' => $request->mother_first_name,
                'mother_middle_name' => $request->mother_middle_name,
                'mother_last_name' => $request->mother_last_name,
                'mother_suffix' => $request->mother_suffix,
            ]);


            //restructure and  insert children
            $children = array_map(function ($item) use ($familyBackground) {
                return ["number" => $item['number'], "name" => $item['name'], "birthday" => $item['birthday'], "family_background_id" => $familyBackground->id];
            }, $request->children);

            $pds->childrenInformations()->createMany($children);

            // educational background
            $pds->educationalBackgrounds()->createMany($request->schools);


            // eligibilities
            $pds->civilServiceEligibilities()->createMany(
                $request->eligibilities
            );

            // work experiences
            $pds->workExperiences()->createMany(
                $request->workExperiences
            );

            // voluntary works
            $pds->voluntaryWorks()->createMany(
                $request->voluntaryWorks
            );

            // trainings
            $pds->trainingPrograms()->createMany(
                $request->trainings
            );

            // specialskills
            $pds->specialSkillHobies()->createMany(
                $request->skills
            );

            // recognitions
            $pds->recognitions()->createMany(
                $request->recognitions
            );

            // membership
            $pds->membershipAssociations()->createMany(
                $request->memberships
            );

            // references
            $pds->references()->createMany(
                $request->characterReferences
            );

            // restructure and insert answers
            $answers = array_map(function ($item) use ($familyBackground) {
                return ["question_id" => $item['question_id'], "answer" => $item['answer'], "details" => $item['details']];
            }, $request->answers);

            $pds->answers()->createMany(
                $answers
            );
        }


        // return message
        return $this->success("", "Successfully Saved", 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $pds = $employee->latestPersonalDataSheet;
        $personalInformation = $pds->personalInformation;
        $familyBackground = $pds->familyBackGround;
        $children = $pds->childrenInformations;
        $schools = $pds->educationalBackgrounds;
        $eligibilities = $pds->civilServiceEligibilities;
        $workExperiences = $pds->workExperiences;
        $voluntaryWorks = $pds->voluntaryWorks;
        $trainings = $pds->trainingPrograms;
        $skills = $pds->specialSkillHobies;
        $recognitions = $pds->recognitions;
        $memberships = $pds->answers;
        $answers = $pds->answers;
        $characterReferences = $pds->references;

        return compact(
            'employee',
            'pds',
            'personalInformation',
            'familyBackground',
            'children',
            'schools',
            'eligibilities',
            'workExperiences',
            'voluntaryWorks',
            'trainings',
            'skills',
            'recognitions',
            'memberships',
            'answers',
            'characterReferences'
        );
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
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
