<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrientationRequest;
use App\Http\Resources\OrientationResource;
use App\Models\EmployeeOrientation;
use App\Models\Orientation;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class OrientationController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrientationResource::collection(
            Orientation::with('employeeOrientation.belongsToEmployee')->get()
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
    public function store(OrientationRequest $request)
    {
        $request->validated($request->all());

        $orientation = Orientation::create([
            
            'date_generated' => Date('Y-m-d', strtotime($request->date_generated)),
            'start_date' =>  Date('Y-m-d', strtotime($request->start_date)),
            'end_date' =>  Date('Y-m-d', strtotime($request->end_date)),
            'venue' => $request->venue,
        ]);
        $employee_ids = $request->input('employee_id');
        foreach($employee_ids as $i => $employee_id){
            EmployeeOrientation::create([
                'employee_id' => $employee_id,
                'orientation_id' => $orientation->id
            ]);
        }

        return $this->success('','Successfully Saved', 200);

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
    public function update(Request $request, Orientation $orientation)
    {
        $orientation->date_generated = $request->date_generated;
        $orientation->start_date = $request->start_date;
        $orientation->end_date = $request->end_date;
        $orientation->venue = $request->venue;
        $orientation->save();

        return new OrientationResource($orientation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orientation $orientation)
    {
            $orientation->delete();

        return $this->success('','Successfully Deleted',200);
    }
}
