<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfficeRequest;
use App\Http\Resources\OfficeResource;
use App\Models\Employee;
use App\Models\Office;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OfficeResource::collection(
            Office::with('belongsToDepartment')
                ->join('departments', 'departments.id', 'offices.department_id')
                ->orderBy('department_name', 'asc')
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
    public function store(StoreOfficeRequest $request)
    {
        $request->validated($request->all());

        $officeExist = Office::where('office_code', $request->office_code)->orWhere("office_name", $request->office_name)->exists();
        if ($officeExist) {
            return $this->error('', 'Duplicate Entry', 400);
        } else {
            Office::create([
                "office_code" => $request->office_code,
                "office_name" => $request->office_name,
                "department_id" => $request->department_id,
            ]);

            return $this->success('', 'Successfully Saved', 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Office $office)
    {
        return $office;
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
    public function update(Request $request, Office $office)
    {
        $office->office_code = $request->office_code;
        $office->office_name = $request->office_name;
        $office->department_id = $request->department_id;
        $office->save();

        return new OfficeResource(
            Office::where('id', $office->id)->join('departments', 'departments.id', 'offices.department_id')->first()
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Office $office)
    {
        $employeesExists = Employee::where('office_id', $office->id)->exists();
        if ($employeesExists) {
            return $this->error('', 'You cannot delete Office with existing employees.', 400);
        } else {
            $office->delete();
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
        $orderBy == null ? $orderBy = "offices.id" : $orderBy = $orderBy;

        $data = OfficeResource::collection(
            Office::where("offices.id", "like", "%" . $searchKeyword . "%")
                ->orWhere("office_name", "like", "%" . $searchKeyword . "%")
                ->orWhere("office_code", "like", "%" . $searchKeyword . "%")
                ->skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->join('departments', 'departments.id', 'offices.department_id')
                ->take(10)
                ->get()
        );

        $pages = Office::where("offices.id", "like", "%" . $searchKeyword . "%")
            ->orWhere("office_name", "like", "%" . $searchKeyword . "%")
            ->orWhere("office_code", "like", "%" . $searchKeyword . "%")
            ->orWhere("department_name", "like", "%" . $searchKeyword . "%")
            ->join('departments', 'departments.id', 'offices.department_id')
            ->orderBy($orderBy, $orderAscending)
            ->count();

        return compact('pages', 'data');
    }
}
