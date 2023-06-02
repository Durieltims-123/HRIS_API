<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Models\Office;
use App\Models\Plantilla;
use App\Models\Position;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    public function store(StoreDepartmentRequest $request)
    {
        $request->validated($request->all());
        $departmentExist = Department::where('department_code', $request->department_code)->orWhere('department_name', $request->department_name)->exists();
        if ($departmentExist) {
            return $this->error('', 'Duplicate Entry', 400);
        } else {
            $department = Department::create([
                'department_code' => $request->department_code,
                'department_name' => $request->department_name,
            ]);

            return $this->success('', 'Successfully Saved', 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return $department;
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
    public function update(StoreDepartmentRequest $request, Department $department)
    {
        $department->department_code = $request->department_code;
        $department->department_name = $request->department_name;
        $department_codes = $request->input('department_code');
        $department_names = $request->input('department_name');
        $department->save();

        return new DepartmentResource($department);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        // validate user from database
        $officeExist = Office::where([['department_id', $department->id]])->exists();
        if ($officeExist) {
            return $this->error('', 'You cannot delete Department with existing offices.', 400);
        } else {
            $department->delete();
            return $this->success('', 'Successfull Deleted', 200);
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

        $data = DepartmentResource::collection(
            Department::where("id", "like", "%" . $searchKeyword . "%")
                ->orWhere("department_name", "like", "%" . $searchKeyword . "%")
                ->orWhere("department_code", "like", "%" . $searchKeyword . "%")
                ->skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->take(10)
                ->get()
        );
        $pages = Department::where("id", "like", "%" . $searchKeyword . "%")
            ->orWhere("department_name", "like", "%" . $searchKeyword . "%")
            ->orWhere("department_code", "like", "%" . $searchKeyword . "%")
            ->orderBy($orderBy, $orderAscending)
            ->count();

        return compact('pages', 'data');
    }
}
