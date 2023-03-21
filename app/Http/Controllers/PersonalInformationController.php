<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonalInformationRequest;
use Illuminate\Http\Request;
use App\Models\PersonalInformation;

class PersonalInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorePersonalInformationRequest $request)
    {
         PersonalInformation::create([
            "pds_id" => $request->pds_id,
            // "pds_id" => $pds->id,
             "mobile_number" => $request->mobile_number,
             "telephone_number" => $request->telephone_number,
             "permanent_house_number" => $request->permanent_house_number,
             "permanent_subdivision_village" => $request->permanent_subdivision_village,
             "permanent_street" => $request->permanent_street,
             "permanent_barangay_id" => $request->permanent_barangay_id,
             "permanent_municipality_id" => $request->permanent_municipality_id,
             "permanent_province_id" => $request->permanent_province_id,
             "permanent_zip_code_number" => $request->permanent_zip_code_number,
             "residential_house_number" => $request->residential_house_number,
             "residential_subdivision_village" => $request->residential_subdivision_village,
             "residential_street" => $request->residential_street,
             "residential_barangay_id" => $request->residential_barangay_id,
             "residential_municipality_id" => $request->residential_municipality_id,
             "residential_province_id" => $request->residential_province_id,
             "residential_zip_code_number" => $request->residential_zip_code_number,
             "citizenship" => $request->citizenship,
             "agency_employee" => $request->agency_employee,
             "tin_number" => $request->tin_number,
             "sss_number" => $request->sss_number,
             "philhealth_number" => $request->philhealth_number,
             "pag_ibig_number" => $request->pag_ibig_number,
             "gsis_number" => $request->gsis_number,
             "blood_type" => $request->blood_type,
             "weight" => $request->weight,
             "height" => $request->height,
             "civil_status" => $request->civil_status,
             "sex" => $request->sex,
             "birthplace" => $request->birthplace,
             "birthdate" => Date('Y-m-d', strtotime($request->birthdate)),
          ]);
 
 
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
