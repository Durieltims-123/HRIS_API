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

        // $employeeExist = Employee::where([["employee_id", $request->employee_id], ["first_name", $request->first_name], ["middle_name", $request->middle_name], ["last_name", $request->last_name]])->exists();

        if ($employeeExist) {
            return $this->error("", "Duplicate Entry", 400);
        } else {

            // Employee Details


            $deleteEmployees = Employee::where([["employee_id", $request->employee_id], ["first_name", $request->first_name], ["middle_name", $request->middle_name], ["last_name", $request->last_name]])->delete();

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


            // $pds = $employee->personalDataSheets()->create(['pds_date' => date('Y-m-d')]);

            $pds =  $employee->personalDataSheets()->create(['pds_date' => date('Y-m-d')]);

            return $pds;

            // dd("hello");

            // dd($pds);


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


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        // $employee->delete();
        // return $this->success("", "Successfully Deleted", 200);
    }
}
