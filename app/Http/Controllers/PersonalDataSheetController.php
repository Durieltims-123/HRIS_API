<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\PersonalDataSheet;
use App\Http\Requests\StorePersonalDataSheetRequest;
use App\Http\Requests\StorePersonalInformationRequest;
use App\Http\Resources\ApplicantResource;
use App\Http\Resources\PersonalDataSheetResource;
use App\Models\Application;
use App\Models\Employee;
use App\Models\PDSRecognition;
use App\Models\PDSFamilyBackground;
use App\Models\PDSChildrenInformation;
use App\Models\PDSPersonalInformation;
use App\Http\Resources\PDSPersonalInformationResource;
use App\Http\Resources\PDSTraningProgramAttendedResource;
use App\Models\PDSAnswer;
use App\Models\PDSCivilServiceEligibility;
use App\Models\PDSEducationalBackground;
use App\Models\PDSMembershipAssociation;
use App\Models\PDSReference;
use App\Models\PDSSpecialSkillHobby;
use App\Models\PDSTrainingProgramAttended;
use App\Models\PDSVoluntaryWork;
use App\Models\PDSWorkExperience;


class PersonalDataSheetController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(PersonalDataSheet::with('hasManyAnswer')->get());
        // return PersonalDataSheetResource::collection(
        //     PersonalDataSheet::with(
        //         'hasManyPersonalInformation',
        //         'hasManyFamilyBackground',
        //         'hasManyChildrenInformation',
        //         'hasManyEducationalBackground',
        //         'hasManyCivilServiceEligibility',
        //         'hasManyWorkExperience',
        //         'hasManyVoluntaryWork',
        //         'hasManyTrainingProgramAttended',
        //         'hasManySpecialSkillHobby',
        //         'hasManyRecognition',
        //         'hasManyMembershipAssociation',
        //         'hasManyAnswer',
        //         'hasManyReference',
        //     )->get()
        // );
        return (
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
                'hasManyReference',
            )->get()
        );

        // return PersonalDataSheetResource::collection(
        //     PersonalDataSheet::all()
        // );
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

        //pds
        $personalDataSheet = PersonalDataSheet::create([
            'applicant_id' => $request->id,
            'employee_id' => $request->id,
        ]);

        // dd($request->barangay_id);
        //personal information
        PDSPersonalInformation::create([
            "personal_data_sheet_id" => $personalDataSheet->id,
            "mobile_number" => $request->mobile_number,
            "telephone_number" => $request->telephone_number,
            "permanent_house_number" => $request->permanent_house_number,
            "permanent_subdivision_village" => $request->permanent_subdivision_village,
            "permanent_street" => $request->permanent_street,
            "barangay_id" => $request->barangay_id,
            "municipality_id" => $request->municipality_id,
            "province_id" => $request->province_id,
            "permanent_zip_code" => $request->permanent_zip_code,
            "residential_house_number" => $request->residential_house_number,
            "residential_subdivision_village" => $request->residential_subdivision_village,
            "residential_street" => $request->residential_street,
            "r_barangay_id" => $request->r_barangay_id,
            "r_municipality_id" => $request->r_municipality_id,
            "r_province_id" => $request->r_province_id,
            "residential_zip_code" => $request->residential_zip_code,
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
            "birth_date" => Date('Y-m-d', strtotime($request->birthdate)),
        ]);


        //family background
        $famBack = PDSFamilyBackground::create([
            "personal_data_sheet_id" => $personalDataSheet->id,
            "spouse_surname" => $request->spouse_surname,
            "spouse_first_name" => $request->spouse_first_name,
            "spouse_middle_name" => $request->spouse_middle_name,
            "suffix" => $request->suffix,
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
            PDSChildrenInformation::create([
                "personal_data_sheet_id" => $personalDataSheet->id,
                "family_background_id" => $famBack->id,
                "children_name" => $name,
                "children_birthdate" => Date('Y-m-d', strtotime($dates[$i]))
            ]);
        }

        //educational background
        PDSEducationalBackground::create([
            "personal_data_sheet_id" => $personalDataSheet->id,
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
            PDSCivilServiceEligibility::create([
                "personal_data_sheet_id" => $personalDataSheet->id,
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
        $offices = $request->input('office');
        $monthlySalarys = $request->input('monthly_salary');
        $salarys = $request->input('salary');
        $statusAppointments = $request->input('status_appointment');
        $governmentServices = $request->input('government_service');
        $inclusiveFroms = $request->input('inclusive_dates_from');
        $inclusiveTos = $request->input('inclusive_dates_to');

        foreach ($offices as $b => $office) {
            PDSWorkExperience::create([
                "personal_data_sheet_id" => $personalDataSheet->id,
                "position_title" => $positionTitles[$b],
                "office" => $office,
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
            PDSVoluntaryWork::create([
                "personal_data_sheet_id" => $personalDataSheet->id,
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
            PDSTrainingProgramAttended::create([
                "personal_data_sheet_id" => $personalDataSheet->id,
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
            PDSSpecialSkillHobby::create([
                "personal_data_sheet_id" => $personalDataSheet->id,
                "special_skills" => $specialSkill,
            ]);
        }

        //recognition
        $recognitionTitles = $request->input('recognition_title');

        foreach ($recognitionTitles as $f => $recognitionTitle) {
            PDSRecognition::create([
                "personal_data_sheet_id" => $personalDataSheet->id,
                "recognition_title" => $recognitionTitle,
            ]);
        }

        //membership association
        $membershipAssociations = $request->input('membership_association');

        foreach ($membershipAssociations as $f => $membershipAssociation) {
            PDSMembershipAssociation::create([
                "personal_data_sheet_id" => $personalDataSheet->id,
                "membership_association" => $membershipAssociation,
            ]);
        }

        //answer
        $choices = $request->input('choice');
        $detailss = $request->input('details');
        $date_fileds = $request->input('date_filed');
        $case_statuss = $request->input('case_status');

        $last_question_id = 0; // Initialize last_question_id to zero
        foreach ($choices as $g => $choice) {
            $question_id = $last_question_id + 1; // Set question_id to last_question_id + 1
            $last_question_id = $question_id; // Update last_question_id to the current question_id

            PDSAnswer::create([
                "personal_data_sheet_id" => $personalDataSheet->id,
                "question_id" => $question_id,
                "details" => $detailss[$g],
                "choice" => $choice,
                "date_filed" => $date_fileds[$g],
                "case_status" => $case_statuss[$g],
            ]);
        }

        //references
        PDSReference::create([
            "personal_data_sheet_id" => $personalDataSheet->id,
            "name" => $request->name,
            "address" => $request->address,
            "telephone_number" => $request->telephone_number,
            "name2" => $request->name2,
            "address2" => $request->address2,
            "telephone_number2" => $request->telephone_number2,
            "name3" => $request->name3,
            "address3" => $request->address3,
            "telephone_number3" => $request->telephone_number3,
        ]);

        return $this->success('', 'Successfully Saved', 200);
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
    public function update(Request $request, PersonalDataSheet $personalDataSheet)
    {
        //PERSONAL INFORMATION
        PDSPersonalInformation::where("personal_data_sheet_id", $personalDataSheet->id)
            ->update([
                'personal_data_sheet_id' =>  $personalDataSheet->id,
                'mobile_number' => $request->mobile_number,
                'telephone_number' => $request->telephone_number,
                'telephone_number' => $request->telephone_number,
                'permanent_house_number' => $request->permanent_house_number,
                'permanent_subdivision_village' => $request->permanent_subdivision_village,
                'permanent_street' => $request->permanent_street,
                // 'barangay_id' => $request->barangay_id,
                // 'municipality_id' => $request->municipality_id,
                // 'province_id' => $request->province_id,
                'permanent_zip_code' => $request->permanent_zip_code,
                'residential_house_number' => $request->residential_house_number,
                'residential_subdivision_village' => $request->residential_subdivision_village,
                'residential_street' => $request->residential_street,
                // 'r_barangay_id' => $request->r_barangay_id,
                // 'r_municipality_id' => $request->r_municipality_id,
                // 'r_province_id' => $request->r_province_id,
                'residential_zip_code' => $request->residential_zip_code,
                'citizenship' => $request->citizenship,
                'agency_employee' => $request->agency_employee,
                'tin_number' => $request->tin_number,
                'sss_number' => $request->sss_number,
                'philhealth_number' => $request->philhealth_number,
                'pag_ibig_number' => $request->pag_ibig_number,
                'gsis_number' => $request->gsis_number,
                'blood_type' => $request->blood_type,
                'weight' => $request->weight,
                'height' => $request->height,
                'civil_status' => $request->civil_status,
                'sex' => $request->sex,
                'birthplace' => $request->birthplace,
                'birth_date' => $request->birthdate

            ]);

        //FAMILY BACKGROUND
        PDSFamilyBackground::where('personal_data_sheet_id', $personalDataSheet->id)
            ->update([
                'personal_data_sheet_id' => $personalDataSheet->id,
                'spouse_surname' => $request->spouse_surname,
                'spouse_first_name' => $request->spouse_first_name,
                'spouse_middle_name' => $request->spouse_middle_name,
                'suffix_name' => $request->suffix,
                'occupation' => $request->occupation,
                'employee_business_name' => $request->employee_business_name,
                'business_address' => $request->business_address,
                'telephone_number' => $request->telephone_number,
                'father_surname' => $request->father_surname,
                'father_first_name' => $request->father_first_name,
                'father_middle_name' => $request->father_middle_name,
                'father_extension_name' => $request->father_extension_name,
                'mother_maiden_surname' => $request->mother_maiden_surname,
                'mother_first_name' => $request->mother_first_name,
                'mother_maiden_middle_name' => $request->mother_maiden_middle_name
            ]);

        //CHILDREN INFORMATION
        $childrenNames = $request->input('children_name');
        $childrenBirthdates = $request->input('children_birthdate');

        foreach ($childrenNames as $i => $childrenName) {
            $memberExists = PDSChildrenInformation::where([
                ['children_name', $childrenName],
                ['personal_data_sheet_id', $personalDataSheet->id]
            ])->exists();
            //check if exist
            if ($memberExists) {
                PDSChildrenInformation::where([['children_name', $childrenName], ['personal_data_sheet_id', $personalDataSheet->id]])
                    ->update([
                        "personal_data_sheet_id" => $personalDataSheet->id,
                        "children_name" => $childrenNames[$i],
                        "children_birthdate" => $childrenBirthdates[$i],
                    ]);
            } else {
                PDSChildrenInformation::create([
                    "personal_data_sheet_id" => $personalDataSheet->id,
                    "family_background_id" => $request->family_background_id,
                    "children_name" => $childrenName,
                    "children_birthdate" => Date('Y-m-d', strtotime($childrenBirthdates[$i])),
                ]);
            }
        }
        $delete = PDSChildrenInformation::where('personal_data_sheet_id', $personalDataSheet->id)
            ->whereNotIn('children_name', $childrenNames)
            ->delete();

        //EDUCATIONAL BACKGROUND
        PDSEducationalBackground::where('personal_data_sheet_id', $personalDataSheet->id)
            ->update([
                'personal_data_sheet_id' => $personalDataSheet->id,
                'level' => $request->level,
                'school_name' => $request->school_name,
                'basic_education' => $request->basic_education,
                'scholarship_honor' => $request->scholarship_honor,
                'highest_level' => $request->highest_level,
                'year_graduated' => $request->year_graduated,
                'eb_inclusive_dates_from' => $request->eb_inclusive_dates_from,
                'eb_inclusive_dates_to' => $request->eb_inclusive_dates_to
            ]);

        //CIVIL SERVICE ELIGIBILITY
        $careerServices = $request->input('career_service');
        $ratings = $request->input('rating');
        $examDates = $request->input('examination_date');
        $placeExams = $request->input('place_examination');
        $licenseNumbers = $request->input('license_number');
        $dateValidities = $request->input('date_validity');

        foreach ($careerServices as $a => $careerService) {
            $memberExists = PDSCivilServiceEligibility::where([
                ['career_service', $careerServices],
                ['personal_data_sheet_id', $personalDataSheet->id]
            ])->exists();
            if ($memberExists) {
                PDSCivilServiceEligibility::where([['career_service', $careerService], ['personal_data_sheet_id', $personalDataSheet->id]])
                    ->update([
                        "personal_data_sheet_id" => $personalDataSheet->id,
                        "career_service" => $careerServices[$a],
                        "rating" => $ratings[$a],
                        "examination_date" => $examDates[$a],
                        "place_examination" => $placeExams[$a],
                        "license_number" => $licenseNumbers[$a],
                        "date_validity" => $dateValidities[$a],
                    ]);
            } else {
                PDSCivilServiceEligibility::create([
                    "personal_data_sheet_id" => $personalDataSheet->id,
                    "career_service" => $careerService,
                    "rating" => $ratings[$a],
                    "examination_date" => Date('Y-m-d', strtotime($examDates[$a])),
                    "place_examination" => $placeExams[$a],
                    "license_number" => $licenseNumbers[$a],
                    "date_validity" => Date('Y-m-d', strtotime($dateValidities[$a])),
                ]);
            }
        }
        $delete = PDSCivilServiceEligibility::where('personal_data_sheet_id', $personalDataSheet->id)
            ->whereNotIn('career_service', $careerServices)
            ->delete();

        //WORK EXPERIENCE
        $positionTitles = $request->input('position_title');
        $offices = $request->input('office');
        $monthlySalarys = $request->input('monthly_salary');
        $salarys = $request->input('salary');
        $statusAppointments = $request->input('status_appointment');
        $governmentServices = $request->input('government_service');
        $inclusiveFroms = $request->input('inclusive_dates_from');
        $inclusiveTos = $request->input('inclusive_dates_to');

        foreach ($positionTitles as $b => $positionTitle) {
            $memberExists = PDSWorkExperience::where([
                ['position_title', $positionTitle],
                ['personal_data_sheet_id', $personalDataSheet->id]
            ])->exists();
            if ($memberExists) {
                PDSWorkExperience::where([['personal_data_sheet_id', $personalDataSheet->id], ['position_title', $positionTitle]])
                    ->update([
                        "personal_data_sheet_id" => $personalDataSheet->id,
                        "position_title" => $positionTitles[$b],
                        "office" => $offices[$b],
                        "monthly_salary" => $monthlySalarys[$b],
                        "salary" => $salarys[$b],
                        "status_appointment" => $statusAppointments[$b],
                        "government_service" => $governmentServices[$b],
                        "inclusive_dates_from" => $inclusiveFroms[$b],
                        "inclusive_dates_to" => $inclusiveTos[$b],

                    ]);
            } else {
                PDSWorkExperience::create([
                    "personal_data_sheet_id" => $personalDataSheet->id,
                    "position_title" => $positionTitle,
                    "office" => $offices[$b],
                    "monthly_salary" => $monthlySalarys[$b],
                    "salary" => $salarys[$b],
                    "status_appointment" => $statusAppointments[$b],
                    "government_service" => $governmentServices[$b],
                    "inclusive_dates_from" => Date('Y-m-d', strtotime($inclusiveFroms[$b])),
                    "inclusive_dates_to" => Date('Y-m-d', strtotime($inclusiveTos[$b])),
                ]);
            }
        }
        $delete = PDSWorkExperience::where('personal_data_sheet_id', $personalDataSheet->id)
            ->whereNotIn('position_title', $positionTitles)
            ->delete();

        //VOLUNTARY WORK
        $organizationNames = $request->input('organization_name');
        $organizationAddress = $request->input('organization_address');
        $positions = $request->input('position');
        $numberHours = $request->input('number_hours');
        $vwInclusiveFrom = $request->input('vw_inclusive_dates_from');
        $vwInclusiveTo = $request->input('vw_inclusive_dates_to');

        foreach ($organizationNames as $c => $organizationName) {
            $memberExists = PDSVoluntaryWork::where([
                ['organization_name', $organizationName],
                ['personal_data_sheet_id', $personalDataSheet->id]
            ])->exists();

            if ($memberExists) {
                PDSVoluntaryWork::where([['personal_data_sheet_id', $personalDataSheet->id], ['organization_name', $organizationName]])
                    ->update([
                        "personal_data_sheet_id" => $personalDataSheet->id,
                        "organization_name" => $organizationNames[$c],
                        "organization_address" => $organizationAddress[$c],
                        "position" => $positions[$c],
                        "number_hours" => $numberHours[$c],
                        "vw_inclusive_dates_from" => $vwInclusiveFrom[$c],
                        "vw_inclusive_dates_to" => $vwInclusiveTo[$c],
                    ]);
            } else {
                PDSVoluntaryWork::create([
                    "personal_data_sheet_id" => $personalDataSheet->id,
                    "organization_address" => $organizationAddress[$c],
                    "organization_name" => $organizationName,
                    "position" => $positions[$c],
                    "number_hours" => $numberHours[$c],
                    "vw_inclusive_dates_from" => Date('Y-m-d', strtotime($vwInclusiveFrom[$c])),
                    "vw_inclusive_dates_to" => Date('Y-m-d', strtotime($vwInclusiveTo[$c])),
                ]);
            }
        }
        $delete = PDSVoluntaryWork::where('personal_data_sheet_id', $personalDataSheet->id)
            ->whereNotIn('organization_name', $organizationNames)
            ->delete();

        //TRAINING PROGRAM ATTENDED
        $programTitles = $request->input('program_title');
        $hours = $request->input('hours');
        $types = $request->input('type');
        $conductedBys = $request->input('conducted_by');
        $tpInclusiveFrom = $request->input('tp_inclusive_dates_from');
        $tpInclusiveTo = $request->input('tp_inclusive_dates_to');

        foreach ($programTitles as $d => $programTitle) {
            $memberExists = PDSTrainingProgramAttended::where([
                ['program_title', $programTitle],
                ['personal_data_sheet_id', $personalDataSheet->id]
            ])->exists();
            if ($memberExists) {
                PDSTrainingProgramAttended::where([['personal_data_sheet_id', $personalDataSheet->id], ['program_title', $programTitle]])
                    ->update([
                        "personal_data_sheet_id" => $personalDataSheet->id,
                        "program_title" => $programTitles[$d],
                        "hours" => $hours[$d],
                        "type" => $types[$d],
                        "conducted_by" => $conductedBys[$d],
                        "tp_inclusive_dates_from" => $tpInclusiveFrom[$d],
                        "tp_inclusive_dates_to" => $tpInclusiveTo[$d],
                    ]);
            } else {
                PDSTrainingProgramAttended::create([
                    "personal_data_sheet_id" => $personalDataSheet->id,
                    "hours" => $hours[$d],
                    "program_title" => $programTitle,
                    "type" => $types[$d],
                    "conducted_by" => $conductedBys[$d],
                    "tp_inclusive_dates_from" => Date('Y-m-d', strtotime($tpInclusiveFrom[$d])),
                    "tp_inclusive_dates_to" => Date('Y-m-d', strtotime($tpInclusiveTo[$d])),
                ]);
            }
        }
        $delete = PDSTrainingProgramAttended::where('personal_data_sheet_id', $personalDataSheet->id)
            ->whereNotIn('program_title', $programTitles)
            ->delete();

        //SPECIAL SKILLS
        $specialSkills = $request->input('special_skills');

        foreach ($specialSkills as $e => $specialSkill) {
            $memberExists = PDSSpecialSkillHobby::where([
                ['special_skills', $specialSkill],
                ['personal_data_sheet_id', $personalDataSheet->id]
            ])->exists();
            //    check if exist
            if ($memberExists) {
                PDSSpecialSkillHobby::where([['personal_data_sheet_id', $personalDataSheet->id], ['special_skills', $specialSkill]])
                    ->update([
                        "personal_data_sheet_id" => $personalDataSheet->id,
                        "special_skills" => $specialSkills[$e],
                    ]);
            } else {
                PDSSpecialSkillHobby::create([
                    "personal_data_sheet_id" => $personalDataSheet->id,
                    "special_skills" => $specialSkill,
                ]);
            }
        }
        $delete = PDSSpecialSkillHobby::where('personal_data_sheet_id', $personalDataSheet->id)
            ->whereNotIn('special_skills', $specialSkills)
            ->delete();

        // //RECOGNITION
        $recognitionTitles = $request->input('recognition_title');

        foreach ($recognitionTitles as $f => $recognitionTitle) {
            $memberExists = PDSRecognition::where([
                ['recognition_title', $recognitionTitle],
                ['personal_data_sheet_id', $personalDataSheet->id]
            ])->exists();
            //    check if exist
            if ($memberExists) {
                PDSRecognition::where([['personal_data_sheet_id', $personalDataSheet->id], ['recognition_title', $recognitionTitle]])
                    ->update([
                        "personal_data_sheet_id" => $personalDataSheet->id,
                        "recognition_title" => $recognitionTitles[$f],
                    ]);
            } else {
                PDSRecognition::create([
                    "personal_data_sheet_id" => $personalDataSheet->id,
                    "recognition_title" => $recognitionTitle,
                ]);
            }
        }
        $delete = PDSRecognition::where('personal_data_sheet_id', $personalDataSheet->id)
            ->whereNotIn('recognition_title', $recognitionTitles)
            ->delete();

        //MEMBERSHIP ASSOCIATION
        $membershipAssociations = $request->input('membership_association');

        foreach ($membershipAssociations as $g => $membershipAssociation) {
            $memberExists = PDSMembershipAssociation::where([
                ['membership_association', $membershipAssociation],
                ['personal_data_sheet_id', $personalDataSheet->id]
            ])->exists();
            //    check if exist
            if ($memberExists) {
                PDSMembershipAssociation::where([['personal_data_sheet_id', $personalDataSheet->id], ['membership_association', $membershipAssociation]])
                    ->update([
                        "personal_data_sheet_id" => $personalDataSheet->id,
                        "membership_association" => $membershipAssociations[$g],
                    ]);
            } else {
                PDSMembershipAssociation::create([
                    "personal_data_sheet_id" => $personalDataSheet->id,
                    "membership_association" => $membershipAssociation,
                ]);
            }
        }
        $delete = PDSMembershipAssociation::where('personal_data_sheet_id', $personalDataSheet->id)
            ->whereNotIn('membership_association', $membershipAssociations)
            ->delete();

        //ANSWERS
        $choices = $request->input('choice');
        $detailss = $request->input('details');
        $date_fileds = $request->input('date_filed');
        $case_statuss = $request->input('case_status');

        $last_question_id = 0; // Initialize last_question_id to zero
        foreach ($choices as $g => $choice) {
            $question_id = $last_question_id + 1; // Set question_id to last_question_id + 1
            $last_question_id = $question_id; // Update last_question_id to the current question_id

            PDSAnswer::where('personal_data_sheet_id', $personalDataSheet->id)
                ->where('question_id', $question_id)
                ->update([
                    "details" => $detailss[$g],
                    "choice" => $choice,
                    "date_filed" => $date_fileds[$g],
                    "case_status" => $case_statuss[$g],
                ]);
        }

        //REFERENCES
        PDSReference::where('personal_data_sheet_id', $personalDataSheet->id)
            ->update([
                'personal_data_sheet_id' => $personalDataSheet->id,
                'name' => $request->name,
                'address' => $request->address,
                'telephone_number' => $request->telephone_number,
                'name2' => $request->name2,
                'address2' => $request->address2,
                'telephone_number2' => $request->telephone_number2,
                'name3' => $request->name3,
                'address3' => $request->address3,
                'telephone_number3' => $request->telephone_number3,
            ]);

        return new PersonalDataSheetResource($personalDataSheet);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonalDataSheet $personalDataSheet)
    {
        $personalDataSheet->delete();
        return $this->success('', 'Successfully Deleted', 200);
    }
}
