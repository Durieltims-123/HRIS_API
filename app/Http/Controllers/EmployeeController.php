<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Models\Office;
use App\Models\Plantilla;
use App\Models\Position;
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
        $request->validated($request->all());
        $employeeExist = Employee::where('employee_code', $request->employee_code)->orWhere('employee_name', $request->employee_name)->exists();
        if ($employeeExist) {
            return $this->error('', 'Duplicate Entry', 400);
        } else {
            $employee = Employee::create([
                'id' => $request->id,
                'code' => $request->code,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'suffixname' => $request->suffixname,
                'contact_number' => $request->contact_number,
                'email_address' => $request->email_address,
                'current_position' => $request->current_position,
                'employent_status' => $request->employment_status,
                'employee_status' => $request->employee_status,
                'orientation_status' => $request->orientation_status,
            ]);

            return $this->success('', 'Successfully Saved', 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return $employee;
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
    public function update(StoreEmployeeRequest $request, Employee $employee)
    {
        $employee->id = $request->id;
        $employee->code = $request->code;
        $employee->firstname = $request->firstname;
        $employee->middlename = $request->middlename;
        $employee->lastname = $request->lastname;
        $employee->suffixname = $request->suffixname;
        $employee->contact_number = $request->contact_number;
        $employee->email_address = $request->email_address;
        $employee->current_position = $request->current_position;
        $employee->employment_status = $request->employment_status;
        $employee->employee_status = $request->employee_status;
        $employee->orientation_status = $request->orientation_status;
        $ids = $request->input('id');
        $codes = $request->input('code');
        $names = $request->input('firstname');
        $middlenames = $request->input('middlename');
        $lastnames = $request->input('lastname');
        $suffixnames = $request->input('suffixname');
        $contact_numbers = $request->input('contact number');
        $email_addresses = $request->input('email address');
        $current_positions = $request->input('current position');
        $employment_statuses = $request->input('employment status');
        $employee_statuses = $request->input('employee status');
        $orientation_statuses = $request->input('orientation status');
        $employee->save();

        return new EmployeeResource($employee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        // validate user from database
        $officeExist = Office::where([['employee_id', $employee->id]])->exists();
        if ($officeExist) {
            return $this->error('', 'You cannot delete Employee with existing offices.', 400);
        } else {
            $employee->delete();
            return $this->success('', 'Successfully Deleted', 200);
        }
    }

    public function search(Request $request)
    {
        $activePage = $request->activePage;
        $searchKeyword = $request->searchKeyword;
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $orderAscending  ? $orderAscending = "asc" : $orderAscending = "desc";
        $searchKeyword == null ? $searchKeyword = "" : $searchKeyword = $searchKeyword;
        $orderBy == null ? $orderBy = "id" : $orderBy = $orderBy;

        $data = EmployeeResource::collection(
            Employee::where("id", "like", "%" . $searchKeyword . "%")
                ->orWhere("id", "like", "%" . $searchKeyword . "%")
                ->orWhere("firstname", "like", "%" . $searchKeyword . "%")
                ->orWhere("code", "like", "%" . $searchKeyword . "%")
                ->orWhere("middlename", "like", "%" . $searchKeyword . "%")
                ->orWhere("lastname", "like", "%" . $searchKeyword . "%")
                ->orWhere("suffixname", "like", "%" . $searchKeyword . "%")
                ->orWhere("contact_number", "like", "%" . $searchKeyword . "%")
                ->orWhere("email_address", "like", "%" . $searchKeyword . "%")
                ->orWhere("current_position", "like", "%" . $searchKeyword . "%")
                ->orWhere("employent_status", "like", "%" . $searchKeyword . "%")
                ->orWhere("employee_status", "like", "%" . $searchKeyword . "%")
                ->orWhere("orientation_status", "like", "%" . $searchKeyword . "%")
                ->skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->take(10)
                ->get()
        );
        $pages = Employee::where("id", "like", "%" . $searchKeyword . "%")
            ->orWhere("id", "like", "%" . $searchKeyword . "%")
            ->orWhere("firstname", "like", "%" . $searchKeyword . "%")
            ->orWhere("code", "like", "%" . $searchKeyword . "%")
            ->orWhere("middlename", "like", "%" . $searchKeyword . "%")
            ->orWhere("lastname", "like", "%" . $searchKeyword . "%")
            ->orWhere("suffixname", "like", "%" . $searchKeyword . "%")
            ->orWhere("contact_number", "like", "%" . $searchKeyword . "%")
            ->orWhere("email_address", "like", "%" . $searchKeyword . "%")
            ->orWhere("current_position", "like", "%" . $searchKeyword . "%")
            ->orWhere("employent_status", "like", "%" . $searchKeyword . "%")
            ->orWhere("employee_status", "like", "%" . $searchKeyword . "%")
            ->orWhere("orientation_status", "like", "%" . $searchKeyword . "%")
            ->orderBy($orderBy, $orderAscending)
            ->count();

        return compact('pages', 'data');
    }
}
