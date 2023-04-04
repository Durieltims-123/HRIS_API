<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Http\Resources\ApplicationResource;
use App\Models\Applicant;
use App\Models\Application;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ApplicationResource::collection(
            Application:: all()
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
    public function store(StoreApplicationRequest $request)
    {
        $request->validated($request->all());

        $applicationExists = Application::where([
            ['applicant_id', $request->applicant_id],
            ['publication_id', $request->publication_id],
            ['first_name', $request->first_name],
            ['middle_name', $request->middle_name],
            ['last_name', $request->last_name]
        ])->exists();
        
        if ($applicationExists) {
            return $this->error('', 'Duplicate Entry', 400);
        }        
        
        Application::create([
            "applicant_id" => $request->applicant_id,
            "employee_id" => $request->employee_id,
            "publication_id" => $request->publication_id,
            "submission_date" => $request->submission_date,
            "first_name" => $request->first_name,
            "middle_name" => $request->middle_name,
            "last_name" => $request->last_name,
            "suffix_name" => $request->suffix_name,
            "application_type" => $request->application_type,
            "status" => 'New'
        ]);

        return $this->success('','Successfully Saved.', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        return new ApplicationResource($application);
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
    public function update(Request $request, Application $application)
    {
        $application->submission_date = $request->submission_date;
        $application->first_name = $request->first_name;
        $application->middle_name = $request->middle_name;
        $application->last_name = $request->last_name;
        $application->suffix_name = $request->suffix_name;
        $application->application_type = $request->application_type;

        $application->save();

        // return $this->success('', 'Successfully Updated', 200);
        return new ApplicationResource($application);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        $application->delete();
        return $this->success('', 'Successfull Deleted', 200);
    }
}
