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
    public function store(StoreEmployeeRequest $request)
    {
        // validate input fields
        $request->validated($request->all());


        $employeeExist = Employee::where([["employee_id", $request->employee_id], ["first_name", $request->first_name], ["middle_name", $request->middle_name], ["last_name", $request->last_name]])->exists();

        if ($employeeExist) {
            return $this->error("", "Duplicate Entry", 400);
        } else {

            // Employee Details

            $employee = Employee::create([
                "division_id" => $request->division_id,
                "employee_id" => $request->first_name,
                "first_name" => $request->first_name,
                "middle_name" => $request->middle_name,
                "last_name" => $request->last_name,
                "suffix" => $request->suffix,
                "mobile_number" => $request->mobile_number,
                "email_address" => $request->email_address,
                "lgu_position_id" => $request->lgu_position_id,
                "employment_status" => $request->employment_status,
                "employee_status" => $request->employee_status
            ]);


            // $pds=PersonalDataSheet::create([
            //     'applicant_id'=>null,
            //     'employee_id' => $employee->id
            // ]);

            // // Personal Information
            // PersonalInformation::create([
            // ]);


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

    public function validation(Request $request)
    {
        $messages = [
            "required" => "This field is required."
        ];

        if ($request->validation_request === "Personal") {
            // $validator = $request->validate([
            //     "employee_id"  => ["required", "string", "max:15"],
            //     "employment_status" =>  ["required", "string"],
            //     "division_id" =>  ["required"],
            //     "division" =>  ["required"],
            //     "division_autosuggest" =>  ["required"],
            //     "first_name" =>  ["required"],
            //     "last_name" =>  ["required"],
            //     "suffix" =>  ["string"],
            //     "birth_place" =>  ["required"],
            //     "birth_date" =>  ["required"],
            //     "age" =>  ["required", "gt:0"],
            //     "sex" =>  ["required"],
            //     "height" =>  ["required", "gt:0"],
            //     "weight" =>  ["required", "gt:0"],
            //     "citizenship" =>  ["required"],
            //     "citizenship_type" =>  ["required_if:citizenship,==,Dual Citizenship"],
            //     "country" =>   ["required_if:citizenship,==,Dual Citizenship"],
            //     "blood_type" =>  ["required"],
            //     "civil_status" =>  ["required"],
            //     "tin" =>  ["required"],
            //     "gsis" =>  ["required"],
            //     "pagibig" =>  ["required"],
            //     "philhealth" =>  ["required"],
            //     "sss" =>  ["nullable", "string"],
            //     "residential_province" =>  ["required"],
            //     "residential_municipality" =>  ["required"],
            //     "residential_barangay" =>  ["required"],
            //     "residential_house" =>  ["required"],
            //     "residential_subdivision" =>  ["required"],
            //     "residential_street" =>  ["required"],
            //     "residential_zipcode" =>  ["required"],
            //     "permanent_province" =>  ["required"],
            //     "permanent_municipality" =>  ["required"],
            //     "permanent_barangay" =>  ["required"],
            //     "permanent_house" =>  ["required"],
            //     "permanent_subdivision" =>  ["required"],
            //     "permanent_street" =>  ["required"],
            //     "permanent_zipcode" =>  ["required"],
            //     "telephone" =>  ["nullable", "string"],
            //     "mobile" =>  ["required"],
            //     "email" =>  ["nullable", "email"],
            // ]);
        }
        if ($request->validation_request === "Family") {
            $validator = $request->validate([
                "spouse_first_name" =>  ["nullable"],
                "spouse_middle_name" =>  ["nullable"],
                "spouse_last_name" =>  ["nullable", "required_with:spouse_first_name"],
                "spouse_suffix" =>   ["nullable", "required_with:spouse_first_name"],
                "spouse_occupation" =>   ["nullable", "required_with:spouse_first_name"],
                "spouse_employer" =>   ["nullable"],
                "spouse_employer_address" =>   ["nullable", "required_with:spouse_employer"],
                "spouse_employer_telephone" =>   ["nullable", "required_with:spouse_employer"],
                "children.*.name" => ["required"],
                "father_first_name" =>  ["required"],
                "father_middle_name" =>  ["nullable"],
                "father_last_name" =>  ["required"],
                "father_suffix" =>  ["nullable"],
                "mother_first_name" =>  ["required"],
                "mother_middle_name" =>  ["nullable"],
                "mother_last_name" =>  ["required"],
                "mother_suffix" =>  ["nullable"]
            ], ["children.*.name.required" => "Child name is required"]);
        }
        if ($request->validation_request === "Education") {
        }
        if ($request->validation_request === "CS Eligibility") {
        }
        if ($request->validation_request === "Learning and Development") {
        }
        if ($request->validation_request === "Other Information") {
        }

        return $this->success("true", "", 200);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return $this->success("", "Successfully Deleted", 200);
    }
}
