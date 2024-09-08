<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentHeadRequest;
use App\Http\Resources\DepartmentHeadResource;
use App\Models\Employee;
use App\Models\DepartmentHead;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class DepartmentHeadController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DepartmentHeadResource::collection(
            DepartmentHead::with('office')
                ->join('offices', 'offices.id', 'department_heads.office_id')
                ->orderBy('office_name', 'asc')
                ->get()
        )->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentHeadRequest $request)
    {
        $request->validated($request->all());

        $departmentHeadExist = DepartmentHead::where([["name", $request->name], ["office_id", $request->office_id]])->exists();

        if ($departmentHeadExist) {
            return $this->error('', 'Duplicate Entry', 400);
        } else {
            DepartmentHead::create([
                "office_id" => $request->office_id,
                "prefix" => $request->prefix,
                "name" => $request->name,
                "position" => $request->position,
                "status" => $request->status,
            ]);

            return $this->success('', 'Successfully Saved', 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DepartmentHead $departmentHead)
    {
        return
            // DepartmentHeadResource::collection(
            DepartmentHead::select('department_heads.*', 'office_id')
            ->where("department_heads.id", $departmentHead->id)
            ->join('offices', 'offices.id', 'department_heads.office_id')
            ->first();
        // );
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
    public function update(StoreDepartmentHeadRequest $request, DepartmentHead $departmentHead)
    {
        $departmentHead->office_id = $request->office_id;
        $departmentHead->prefix = $request->prefix;
        $departmentHead->name = $request->name;
        $departmentHead->position = $request->position;
        $departmentHead->status = $request->status;
        $departmentHead->save();

        return new DepartmentHeadResource(
            DepartmentHead::where('department_heads.id', $departmentHead->id)->join('offices', 'offices.id', 'department_heads.office_id')->first()
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DepartmentHead $departmentHead)
    {
        $employeesExists = Employee::where('division_id', $departmentHead->id)->exists();
        if ($employeesExists) {
            return $this->error('', 'You cannot delete DepartmentHead with existing employees.', 400);
        } else {
            $departmentHead->delete();
            return $this->success('', 'Successfully Deleted', 200);
        }
    }

    public function search(Request $request)
    {

        $activePage = $request->activePage;
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $orderAscending  ? $orderAscending = "asc" : $orderAscending = "desc";
        $orderBy == null ? $orderBy = "department_heads.id" : $orderBy = $orderBy;
        $filters = $request->filters;



        if (!is_null($filters)) {
            $filters =  array_map(function ($filter) {
                if ($filter['column'] === "id") {
                    return ['department_heads.id', 'like', '%' . $filter['value'] . '%'];
                } else {
                    return [$filter['column'], 'like', '%' . $filter['value'] . '%'];
                }
            }, $filters);
        } else {
            $filters = [['department_heads.id', 'like', '%']];
        }

        $data = DepartmentHeadResource::collection(
            DepartmentHead::select('department_heads.*',  'office_name')
                ->where($filters)
                ->skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->join('offices', 'offices.id', 'department_heads.office_id')
                ->take(10)
                ->get()
        );

        $pages = DepartmentHead::select('department_heads.*', 'office_name')
            ->where($filters)
            ->join('offices', 'offices.id', 'department_heads.office_id')
            ->orderBy($orderBy, $orderAscending)
            ->count();




        return compact('pages', 'data');
    }
}
