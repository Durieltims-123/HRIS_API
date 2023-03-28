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

        $department = Department::create([
            'department_code' => $request->department_code,
            'department_name' => $request->department_name,
        ]);
        $office_codes = $request->input('office_code');
        $office_names = $request->input('office_name');

        foreach($office_codes as $i => $office_code){
            Office::create([
                'department_id' => $department->id,
                'office_code' => $office_code,
                'office_name' => $office_names[$i],
            ]);
        }

        return $this->success('', 'Successfull Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $office_codes = $request->input('office_code');
        $office_names = $request->input('office_name');

       
        foreach($office_codes as $i => $office_code){
            Office::where('department_id', $department->id)
            ->update([
                'office_code'=> $office_code,
                'office_name'=> $office_names[$i],
            ]);
        }

        $department->save();

        return new DepartmentResource($department);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return $this->success('', 'Successfull Deleted', 200);
    }
}
