<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDivisionRequest;
use App\Http\Resources\DivisionResource;
use App\Models\Employee;
use App\Models\Division;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DivisionResource::collection(
            Division::with('belongsToOffice')
                ->join('offices', 'offices.id', 'divisions.office_id')
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
    public function store(StoreDivisionRequest $request)
    {
        $request->validated($request->all());

        $divisionExist = Division::where('division_code', $request->code)->orWhere("division_name", $request->name)->exists();
        if ($divisionExist) {
            return $this->error('', 'Duplicate Entry', 400);
        } else {
            Division::create([
                "division_code" => $request->code,
                "division_name" => $request->name,
                "office_id" => $request->office_id,
                "division_type" => $request->type,
            ]);

            return $this->success('', 'Successfully Saved', 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Division $division)
    {
        return
            // DivisionResource::collection(
            Division::select('divisions.id', 'office_id', 'division_code', 'division_name', 'office_name', 'divisions.division_type')
            ->where("divisions.id", $division->id)
            ->join('offices', 'offices.id', 'divisions.office_id')
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
    public function update(StoreDivisionRequest $request, Division $division)
    {
        $division->division_code = $request->code;
        $division->division_name = $request->name;
        $division->office_id = $request->office_id;
        $division->division_type = $request->type;
        $division->save();

        return new DivisionResource(
            Division::where('divisions.id', $division->id)->join('offices', 'offices.id', 'divisions.office_id')->first()
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division)
    {
        $employeesExists = Employee::where('division_id', $division->id)->exists();
        if ($employeesExists) {
            return $this->error('', 'You cannot delete Division with existing employees.', 400);
        } else {
            $division->delete();
            return $this->success('', 'Successfully Deleted', 200);
        }
    }

    public function search(Request $request)
    {

        $activePage = $request->activePage;
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $orderAscending  ? $orderAscending = "asc" : $orderAscending = "desc";
        $orderBy == null ? $orderBy = "divisions.id" : $orderBy = $orderBy;
        $filters = $request->filters;
        if (count($filters) > 0) {
            $filters =  array_map(function ($filter) {
                if ($filter['column'] === "id") {
                    return ['divisions.id', 'like', '%' . $filter['value'] . '%'];
                } else {
                    return [$filter['column'], 'like', '%' . $filter['value'] . '%'];
                }
            }, $filters);
        } else {
            $filters = [['divisions.id', 'like', '%']];
        }

        $data = DivisionResource::collection(
            Division::select('divisions.id', 'division_code', 'division_name', 'office_name', 'divisions.division_type')
                ->where($filters)
                ->skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->join('offices', 'offices.id', 'divisions.office_id')
                ->take(10)
                ->get()
        );

        $pages = Division::select('divisions.id', 'division_code', 'division_name', 'office_name')
            ->where($filters)
            ->join('offices', 'offices.id', 'divisions.office_id')
            ->orderBy($orderBy, $orderAscending)
            ->count();

        return compact('pages', 'data');
    }
}
