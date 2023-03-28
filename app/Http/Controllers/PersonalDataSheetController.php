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
use App\Http\Resources\PersonalDataSheetResource;
use App\Http\Resources\PersonalInformationResource;
use App\Models\CivilServiceEligibility;
use App\Models\EducationalBackground;
use App\Models\MembershipAssociation;
use App\Models\Reference;
use App\Models\SpecialSkillHobby;
use App\Models\TrainingProgramAttended;
use App\Models\VoluntaryWork;
use App\Models\WorkExperience;

class PersonalDataSheetController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(PersonalDataSheet::with('hasManyPersonalInformation')->get());
        return PersonalDataSheetResource::collection(
            PersonalDataSheet::with(
                'hasManyPersonalInformation',
                'hasManyFamilyBackground',
                'hasManyChildrenInformation',
                'hasManyEducationalBackground',
                'hasManyCivilServiceEligibility',
                'hasManyWorkExperience',
                'hasManyVoluntaryWork',
                'hasManyTrainingProgramAttended',
                'hasManySpecialSkillHobby',
                'hasManyRecognition',
                'hasManyMembershipAssociation',
                'hasManyAnswer',
                'hasManyOtherInformationAnswer',
                'hasManyReference',
            )->get()
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
    public function store(StorePersonalDataSheetRequest $request)
    {
        // validate input fields
        $request->validated($request->all());

        //applicant
        $applicant = Applicant::create([
            "first_name" => $request->first_name,
            "middle_name" => $request->middle_name,
            "last_name" => $request->last_name,
            "suffix_name" => $request->suffix_name,
            "contact_number" => $request->contact_number,
            "email_address" => $request->email_address
        ]);
        // dd($request->email_address);

        //pds
        $pds = PersonalDataSheet::create([
            'applicant_id' => $applicant->id,
        ]);

        //personal information
        PersonalInformation::create([
            "personal_data_sheet_id" => $pds->id,
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


        //family background
        $famBack = FamilyBackground::create([
            "personal_data_sheet_id" => $pds->id,
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

        //children information
        $names = $request->input('children_name');
        $dates = $request->input('children_birthdate');

        foreach ($names as $i => $name) {
            ChildrenInformation::create([
                "personal_data_sheet_id" => $pds->id,
                "family_background_id" => $famBack->id,
                "children_name" => $name,
                "children_birthdate" => Date('Y-m-d', strtotime($dates[$i]))
            ]);
        }

        //educational background
        EducationalBackground::create([
            "personal_data_sheet_id" => $pds->id,
            "level" => $request->level,
            "school_name" => $request->school_name,
            "basic_education" => $request->basic_education,
            "scholarship_honor" => $request->scholarship_honor,
            "highest_level" => $request->highest_level,
            "year_graduated" => $request->year_graduated,
            "eb_inclusive_dates_from" => Date('Y-m-d', strtotime($request->eb_inclusive_dates_from)),
            "eb_inclusive_dates_to" => Date('Y-m-d', strtotime($request->eb_inclusive_dates_to)),
        ]);

        //civil service eligibility
        $careers = $request->input('career_service');
        $ratings = $request->input('rating');
        $edates = $request->input('examination_date');
        $places = $request->input('place_examination');
        $licenses = $request->input('license_number');
        $vdates = $request->input('date_validity');

        foreach ($ratings as $a => $rating) {
            CivilServiceEligibility::create([
                "personal_data_sheet_id" => $pds->id,
                "career_service" => $careers[$a],
                "rating" => $rating,
                "examination_date" => Date('Y-m-d', strtotime($edates[$a])),
                "place_examination" => $places[$a],
                "license_number" => $licenses[$a],
                "date_validity" => Date('Y-m-d', strtotime($vdates[$a])),
            ]);
        }

        //work experience
        $positionTitles = $request->input('position_title');
        $departments = $request->input('department');
        $monthlySalarys = $request->input('monthly_salary');
        $salarys = $request->input('salary');
        $statusAppointments = $request->input('status_appointment');
        $governmentServices = $request->input('government_service');
        $inclusiveFroms = $request->input('inclusive_dates_from');
        $inclusiveTos = $request->input('inclusive_dates_to');

        foreach ($departments as $b => $department) {
            WorkExperience::create([
                "personal_data_sheet_id" => $pds->id,
                "position_title" => $positionTitles[$b],
                "department" => $department,
                "monthly_salary" => $monthlySalarys[$b],
                "salary" => $salarys[$b],
                "status_appointment" => $statusAppointments[$b],
                "government_service" => $governmentServices[$b],
                "inclusive_dates_from" => Date('Y-m-d', strtotime($inclusiveFroms[$b])),
                "inclusive_dates_to" => Date('Y-m-d', strtotime($inclusiveTos[$b])),
            ]);
        }

        //voluntary work
        $organizationNames = $request->input('organization_name');
        $organizationAddress = $request->input('organization_address');
        $positions = $request->input('position');
        $numberHours = $request->input('number_hours');
        $vwInclusiveFrom = $request->input('vw_inclusive_dates_from');
        $vwInclusiveTo = $request->input('vw_inclusive_dates_to');

        foreach ($organizationNames as $c => $organizationName) {
            VoluntaryWork::create([
                "personal_data_sheet_id" => $pds->id,
                "organization_address" => $organizationAddress[$c],
                "organization_name" => $organizationName,
                "position" => $positions[$c],
                "number_hours" => $numberHours[$c],
                "vw_inclusive_dates_from" => Date('Y-m-d', strtotime($vwInclusiveFrom[$c])),
                "vw_inclusive_dates_to" => Date('Y-m-d', strtotime($vwInclusiveTo[$c])),
            ]);
        }

        //traning program attended
        $programTitles = $request->input('program_title');
        $hours = $request->input('hours');
        $types = $request->input('type');
        $conductedBys = $request->input('conducted_by');
        $tpInclusiveFrom = $request->input('tp_inclusive_dates_from');
        $tpInclusiveTo = $request->input('tp_inclusive_dates_to');

        foreach ($programTitles as $d => $programTitle) {
            TrainingProgramAttended::create([
                "personal_data_sheet_id" => $pds->id,
                "hours" => $hours[$d],
                "program_title" => $programTitle,
                "type" => $types[$d],
                "conducted_by" => $conductedBys[$d],
                "tp_inclusive_dates_from" => Date('Y-m-d', strtotime($tpInclusiveFrom[$d])),
                "tp_inclusive_dates_to" => Date('Y-m-d', strtotime($tpInclusiveTo[$d])),
            ]);
        }

        //special skills
        $specialSkills = $request->input('special_skills');

        foreach ($specialSkills as $e => $specialSkill) {
            SpecialSkillHobby::create([
                "personal_data_sheet_id" => $pds->id,
                "special_skills" => $specialSkill,
            ]);
        }

        //recognition
        $recognitionTitles = $request->input('recognition_title');

        foreach ($recognitionTitles as $f => $recognitionTitle) {
            Recognition::create([
                "personal_data_sheet_id" => $pds->id,
                "recognition_title" => $recognitionTitle,
            ]);
        }

        //membership association
        $membershipAssociations = $request->input('membership_association');

        foreach ($membershipAssociations as $f => $membershipAssociation) {
            MembershipAssociation::create([
                "personal_data_sheet_id" => $pds->id,
                "membership_association" => $membershipAssociation,
            ]);
        }


        // Recognition::create([
        //     "pds_id" => $pds->id,
        //     "recognition_title" => $request->recognition_title,
        // ]);

        // Reference::create([
        //     "pds_id" => $pds->id,
        //     "name" => $request->name,
        //     "address" => $request->address,
        //     "telephone_number" => $request->telephone_number,
        //     "name2" => $request->name2,
        //     "address2" => $request->address2,
        //     "telephone_number2" => $request->telephone_number2,
        //     "name3" => $request->name3,
        //     "address3" => $request->address3,
        //     "telephone_number3" => $request->telephone_number3
        // ]);

        return $this->success('', 'Successfull Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PersonalDataSheet $personalDataSheet)
    {
        return PersonalDataSheetResource::collection(
            PersonalDataSheet::with(
                'hasManyPersonalInformation',
                'hasManyFamilyBackground',
                'hasManyChildrenInformation',
                'hasManyEducationalBackground',
                'hasManyCivilServiceEligibility',
                'hasManyWorkExperience',
                'hasManyVoluntaryWork',
                'hasManyTrainingProgramAttended',
                'hasManySpecialSkillHobby',
                'hasManyRecognition',
                'hasManyMembershipAssociation',
                'hasManyAnswer',
                'hasManyOtherInformationAnswer',
                'hasManyReference',
            )
                ->where('id', $personalDataSheet->id)
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
    public function update(StorePersonalDataSheetRequest $pdsRequest, PersonalInformation $personalInformation)
    {
        $pdsRequest->validated($pdsRequest->all());

        $personalInformation->mobile_number = $pdsRequest->mobile_number;
        $personalInformation->telephone_number = $pdsRequest->telephone_number;
        $personalInformation->permanent_house_number = $pdsRequest->permanent_house_number;
        $personalInformation->permanent_subdivision_village = $pdsRequest->permanent_subdivision_village;
        $personalInformation->permanent_street = $pdsRequest->permanent_street;
        $personalInformation->permanent_barangay_id = $pdsRequest->permanent_barangay_id;
        $personalInformation->permanent_municipality_id = $pdsRequest->permanent_municipality_id;
        $personalInformation->permanent_province_id = $pdsRequest->permanent_province_id;
        $personalInformation->permanent_zip_code_number = $pdsRequest->permanent_zip_code_number;
        $personalInformation->residential_house_number = $pdsRequest->residential_house_number;

        $personalInformation->residential_subdivision_village = $pdsRequest->residential_subdivision_village;
        $personalInformation->residential_street = $pdsRequest->residential_street;
        $personalInformation->residential_barangay_id = $pdsRequest->residential_barangay_id;
        $personalInformation->residential_municipality_id = $pdsRequest->residential_municipality_id;
        $personalInformation->residential_province_id = $pdsRequest->residential_province_id;
        $personalInformation->residential_zip_code_number = $pdsRequest->residential_zip_code_number;
        $personalInformation->citizenship = $pdsRequest->citizenship;
        $personalInformation->agency_employee = $pdsRequest->agency_employee;
        $personalInformation->tin_number = $pdsRequest->tin_number;
        $personalInformation->sss_number = $pdsRequest->sss_number;

        $personalInformation->philhealth_number = $pdsRequest->philhealth_number;
        $personalInformation->pag_ibig_number = $pdsRequest->pag_ibig_number;
        $personalInformation->gsis_number = $pdsRequest->gsis_number;
        $personalInformation->blood_type = $pdsRequest->blood_type;
        $personalInformation->weight = $pdsRequest->weight;
        $personalInformation->height = $pdsRequest->height;
        $personalInformation->civil_status = $pdsRequest->civil_status;
        $personalInformation->sex = $pdsRequest->sex;
        $personalInformation->birthplace = $pdsRequest->birthplace;
        $personalInformation->birthdate = $pdsRequest->birthdate;

        $personalInformation->save();

        return new PersonalDataSheetResource($personalInformation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonalDataSheet $personalDataSheet)
    {
        $personalDataSheet->delete();
        return $this->success('', 'Successfull Deleted', 200);
    }
}
