<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

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

        $employeeExist = Employee::where([['first_name', $request->first_name], ['middle_name', $request->middle_name], ['last_name', $request->last_name]])->exists();
        if ($employeeExist) {
            return $this->error('', 'Duplicate Entry', 400);
        }

        Employee::create([
            "division_id" => $request->division_id,
            "first_name" => $request->first_name,
            "middle_name" => $request->middle_name,
            "last_name" => $request->last_name,
            "suffix_name" => $request->suffix_name,
            "contact_number" => $request->contact_number,
            "email_address" => $request->email_address,
            "current_position" => $request->current_position,
            "employment_status" => $request->employment_status,
            "employee_status" => $request->employee_status,
            "orientation_status" => $request->orientation_status
        ]);


        // return message
        return $this->success('', 'Successfully Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return EmployeeResource::collection(
            Employee::where('id',$employee->id)
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
        $employee->delete();
        return $this->success('', 'Successfully Deleted', 200);
    }
}
