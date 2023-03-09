<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use App\Http\Resources\ApplicantResource;
use App\Http\Requests\StoreApplicantRequest;
use App\Http\Models\Applicant;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
use HttpResponses;

    public function index()
    {
        return ApplicantResource::collection 
        (
            ApplicantResource::all()
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
        // $request -> validated($request->all());

        // $applicantExist = Applicant::where(['first_name', $request->first_name, ['middle_name', $request->middle_name], ['last_name', $request->last_name], ['suffix_name', $request->suffix_name], ['contact_number', $request->contact_number], ['email_address', $request->email_address]])->exists();

        // if ($applicantExist)
        //     {
        //         return $this->error('', 'Duplicate Entry', 400);

        //         Applicant::create
        //         (
        //             [
        //                 "first_name" => $request->first_name,
        //                 "middle_name" => $request->middle_name,
        //                 "last_name" => $request->last_name,
        //                 "suffix_name" => $request->suffix_name,
        //                 "contact_number" => $request->contact_number,
        //                 "email_address" => $request->email_address,
        //             ]
        //         )
        //     }
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
    public function update() //Request $request, Applicant $applicant
    {
        // $applicant->first_name = $request->first_name;
        // $applicant->middle_name = $request->middle_name;$applicant->last_name = $request->last_name;$applicant->suffix_name = $request->suffix_name;$applicant->contact_number = $request->contact_number;$applicant->email_address = $request->email_address;

        // $applicant->save();
        //     return new ApplicantResource($ApplicantResource);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy() //Applicant $applicant
    {
        // $applicant->delete();
        // return $this->success('', 'Successful Alfigy Deleted', 200);
    }
}
