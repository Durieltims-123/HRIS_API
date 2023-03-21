<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Recognition;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\FamilyBackground;
use App\Models\PersonalDataSheet;
use App\Models\ChildrenInformation;
use App\Models\PersonalInformation;
use App\Http\Requests\StorePersonalDataSheetRequest;
use App\Http\Requests\StorePersonalInformationRequest;
use App\Models\EducationalBackground;
use App\Models\Reference;

class PersonalDataSheetController extends Controller
{
    use HttpResponses;
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
    public function store(StorePersonalDataSheetRequest $request)
    {
         // validate input fields
          $request->validated($request->all());
        
          $applicant = Applicant::create([
            "first_name" => $request->first_name,
            "middle_name" => $request->middle_name,
            "last_name" => $request->last_name,
            "suffix_name" => $request->suffix_name,
            "contact_number" => $request->contact_number,
            "email_address" => $request->email_address
        ]);


        $pds = PersonalDataSheet::create([
            'applicant_id'=> $applicant->id,
        ]);
        
         PersonalInformation::create([
            "pds_id" => $pds->id,
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
         
         Recognition::create([
            "pds_id" => $pds->id,
            "recognition_title" => $request->recognition_title,
        ]);
        
        FamilyBackground::create([
            "pds_id" => $pds->id,
            "spouse_surname" => $request->spouse_surname,
            "spouse_first_name" => $request->spouse_first_name,
            "spouse_middle_name" => $request->spouse_middle_name,
            "name_extension" => $request->name_extension,
            "occupation" => $request->occupation,
            "employee_business_name" => $request->employee_business_name,
            "business_address" => $request->business_address,
            "telephone_number" => $request->telephone_number,
            "father_surname" => $request->father_surname,
            "father_first_name" => $request->father_first_name,
            "father_middle_name" => $request->father_middle_name,
            "father_extension_name" => $request->father_extension_name,
            "mother_maiden_surname" => $request->mother_maiden_surname,
            "mother_first_name" => $request->mother_first_name,
            "mother_maiden_middle_name" => $request->mother_maiden_middle_name
        ]);

        // // $pdsId = $request->input('pds_id');
        // // $famId = $request->input('family_background_id');
        // $name = $request->input('children_name');
        // $date = $request->input('children_birthdate');

        // $names = (explode(",", $name));
        // // $pdsIds = (explode(",", $pdsId));
        // // $famIds = (explode(",", $famId));
        // $dates = (explode(",", $date));

        // foreach ($names as $i => $name){
        //     ChildrenInformation::create([
        //         // "pds_id" => $pdsIds[$i],
        //         "family_background_id" => $familyBackground->id,
        //         "children_name" => $name,
        //         "children_birthdate" => $dates[$i]
        //     ]);
        // }

        EducationalBackground::create([
            "pds_id" => $pds->id,
            "level" => $request->level,
            "school_name" => $request->school_name,
            "basic_education" => $request->basic_education,
            "scholarship_honor" => $request->scholarship_honor,
            "highest_level" => $request->highest_level,
            "year_graduated" => $request->year_graduated,
            "inclusive_dates_from" => Date('Y-m-d', strtotime($request->inclusive_dates_from)),
            "inclusive_dates_to" => Date('Y-m-d', strtotime($request->inclusive_dates_to)),
        ]);

        Reference::create([
            "pds_id" => $pds->id,
            "name" => $request->name,
            "address" => $request->address,
            "telephone_number" => $request->telephone_number,
            "name2" => $request->name2,
            "address2" => $request->address2,
            "telephone_number2" => $request->telephone_number2,
            "name3" => $request->name3,
            "address3" => $request->address3,
            "telephone_number3" => $request->telephone_number3
        ]);

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
