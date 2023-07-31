<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Models\Vacancy;
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

    public function search(Request $request)
    {
        $activePage = $request->activePage;
        $status = $request->status;
        // initial test
        $searchKeyword = $request->searchKeyword;
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $year = $request->year;

        $filter = $request->filter;

        $orderAscending  ? $orderAscending = 'asc' : $orderAscending = 'desc';
        $searchKeyword == null ? $searchKeyword = '' : $searchKeyword = $searchKeyword;
        ($orderBy == null || $orderBy == 'id') ? $orderBy = 'employees.id' : $orderBy = $orderBy;

        $data = EmployeeResource::collection(
            Employee::select(
                '*',
                'employees.id',
                'lgu_positions.division_id',
                'first_name',
                'middle_name',
                'last_name',
                'suffix_name',
                'contact_number',
                'email_address',
            )
                ->join('lgu_positions', 'lgu_positions.id', 'employees.lgu_position_id')
                ->join('positions', 'positions.id', 'lgu_positions.position_id')
                ->join('divisions', 'lgu_positions.division_id', 'divisions.id')
                ->join('offices', 'offices.id', 'divisions.office_id')
                ->join('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
                // ->where([['vacancies.date_submitted', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
                // ->where([['lgu_positions.id', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
                // ->orwhere([['positions.title', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
                // ->orwhere([['lgu_positions.item_number', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
                // ->orwhere([['qualification_standards.education', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
                // ->orwhere([['qualification_standards.eligibility', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
                // ->orwhere([['qualification_standards.training', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
                // ->orwhere([['qualification_standards.experience', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
                // ->orwhere([['position_descriptions.description', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
                ->skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->take(10)
                ->get()
        );
        $pages =
            Employee::select(
                '*',
                'employees.id',
                'lgu_positions.division_id',
                'first_name',
                'middle_name',
                'last_name',
                'suffix_name',
                'contact_number',
                'email_address'
            )
            ->join('lgu_positions', 'lgu_positions.id', 'employees.lgu_position_id')
            ->join('positions', 'positions.id', 'lgu_positions.position_id')
            ->join('divisions', 'lgu_positions.division_id', 'divisions.id')
            ->join('offices', 'offices.id', 'divisions.office_id')
            ->join('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
            // ->where([['vacancies.date_submitted', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
            // ->where([['lgu_positions.id', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
            // ->orwhere([['positions.title', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
            // ->orwhere([['lgu_positions.item_number', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
            // ->orwhere([['qualification_standards.education', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
            // ->orwhere([['qualification_standards.eligibility', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
            // ->orwhere([['qualification_standards.training', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
            // ->orwhere([['qualification_standards.experience', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
            // ->orwhere([['position_descriptions.description', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
            ->count();

        return compact('pages', 'data', 'filter');
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
            Employee::where('id', $employee->id)
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
