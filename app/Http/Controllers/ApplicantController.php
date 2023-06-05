<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use App\Http\Resources\ApplicantResource;
use App\Http\Requests\StoreApplicantRequest;
use App\Models\Applicant;
use App\Models\Application;
// use App\Models\Applicant as ModelsApplicant;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use HttpResponses;

    public function index()
    {
        return ApplicantResource::collection(
            Applicant::all()
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
    public function store(StoreApplicantRequest $request)
    {
        // validate input fields
        $request->validated($request->all());

        Applicant::create([
            "first_name" => $request->first_name,
            "middle_name" => $request->middle_name,
            "last_name" => $request->last_name,
            "suffix_name" => $request->suffix_name,
            "contact_number" => $request->contact_number,
            "email_address" => $request->email_address
        ]);

        // return message
        return $this->success('', 'Successfully Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Applicant $applicant)
    {
        return ApplicantResource::collection(
            Applicant::where('id', $applicant->id)
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
    public function update(Request $request, Applicant $applicant)
    {
        $applicant->first_name = $request->first_name;
        $applicant->middle_name = $request->middle_name;
        $applicant->last_name = $request->last_name;
        $applicant->suffix_name = $request->suffix_name;
        $applicant->contact_number = $request->contact_number;
        $applicant->email_address = $request->email_address;
        $applicant->save();
        
        return new ApplicantResource($applicant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicant $applicant)
    {
        $applicant->delete();
        return $this->success('', 'Successfully Deleted', 200);
    }
}
