<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use App\Http\Resources\ApplicantResource;
use App\Http\Requests\StoreApplicantRequest;
use App\Models\Applicant;
// use App\Models\Applicant as ModelsApplicant;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ApplicantResource::collection(
            Applicant::all()
        );
    }

    public function search(Request $request)
    {
        $activePage = $request->activePage;
        $status = $request->status;
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $year = $request->year;
        $filter = $request->filter;
        $orderAscending  ? $orderAscending = "asc" : $orderAscending = "desc";

        ($orderBy == null || $orderBy == "id") ? $orderBy = "applicants.id" : $orderBy = $orderBy;
        $filters = $request->filters;
        if (!is_null($filters)) {
            $filters =  array_map(function ($filter) {
                if ($filter["column"] === "id") {
                    return ["applicants.id", "like", "%" . $filter["value"] . "%"];
                } else {
                    return [$filter["column"], "like", "%" . $filter["value"] . "%"];
                }
            }, $filters);
        } else {
            $filters = [["applicants.id", "like", "%"]];
        }

        $data = ApplicantResource::collection(
            Applicant::select(
                "*"
            )
                ->where($filters)
                ->skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->take(10)
                ->get()
        );

        $pages =
            Applicant::select(
                "applicants.id"
            )
            ->where($filters)
            ->count();

        return compact("pages", "data");
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

        // validate attachments

        $applicantExist = Applicant::where([["first_name", $request->first_name], ["middle_name", $request->middle_name], ["last_name", $request->last_name]])->exists();

        if ($applicantExist) {
            return $this->error("", "Duplicate Entry", 400);
        } else {

            // create applicant

            $applicant = Applicant::create([
                "first_name" => $request->first_name,
                "middle_name" => $request->middle_name,
                "last_name" => $request->last_name,
                "suffix" => $request->suffix,
                "mobile_number" => $request->mobile_number,
                "email_address" => $request->email_address
            ]);


            $pds =  $applicant->personalDataSheets()->create(['pds_date' => date('Y-m-d')]);

            // personal Information
            $personalnformation = $pds->personalInformation()->create(
                [
                    'birth_place' => $request->birth_place,
                    'birth_date' => Date('Y-m-d', strtotime($request->birth_date)),
                    'age' => $request->age,
                    'sex' => $request->sex,
                    'height' => $request->height,
                    'weight' => $request->weight,
                    'citizenship' => $request->citizenship,
                    'citizenship_type' => $request->citizenship_type,
                    'country' => $request->country,
                    'blood_type' => $request->blood_type,
                    'civil_status' => $request->civil_status,
                    'tin' => $request->tin,
                    'gsis' => $request->gsis,
                    'pagibig' => $request->pagibig,
                    'philhealth' => $request->philhealth,
                    'sss' => $request->sss,
                    'residential_province' => $request->residential_province,
                    'residential_municipality' => $request->residential_municipality,
                    'residential_barangay' => $request->residential_barangay,
                    'residential_house' => $request->residential_house,
                    'residential_subdivision' => $request->residential_subdivision,
                    'residential_street' => $request->residential_street,
                    'residential_zipcode' => $request->residential_zipcode,
                    'permanent_province' => $request->permanent_province,
                    'permanent_municipality' => $request->permanent_municipality,
                    'permanent_barangay' => $request->permanent_barangay,
                    'permanent_house' => $request->permanent_house,
                    'permanent_subdivision' => $request->permanent_subdivision,
                    'permanent_street' => $request->permanent_street,
                    'permanent_zipcode' => $request->permanent_zipcode,
                    'telephone' => $request->telephone,
                    'mobile_number' => $request->mobile_number,
                    'email_address' => $request->email_address
                ]
            );

            // Family background
            $familyBackground = $pds->familyBackGround()->create([
                'spouse_first_name' => $request->spouse_first_name,
                'spouse_middle_name' => $request->spouse_middle_name,
                'spouse_last_name' => $request->spouse_last_name,
                'spouse_suffix' => $request->spouse_suffix,
                'spouse_occupation' => $request->spouse_occupation,
                'spouse_employer' => $request->spouse_employer,
                'spouse_employer_address' => $request->spouse_employer_address,
                'spouse_employer_telephone' => $request->spouse_employer_telephone,
                'father_first_name' => $request->father_first_name,
                'father_middle_name' => $request->father_middle_name,
                'father_last_name' => $request->father_last_name,
                'father_suffix' => $request->father_suffix,
                'mother_first_name' => $request->mother_first_name,
                'mother_middle_name' => $request->mother_middle_name,
                'mother_last_name' => $request->mother_last_name,
                'mother_suffix' => $request->mother_suffix,
            ]);


            //restructure and  insert children
            $children = array_map(function ($item) use ($familyBackground) {
                return ["number" => $item['number'], "name" => $item['name'], "birthday" => Date('Y-m-d', strtotime($item['birthday'])), "pds_family_background_id" => $familyBackground->id];
            }, $request->children);


            $eligibilities = array_map(function ($item) {
                return [
                    "date_of_examination_conferment" => Date('Y-m-d', strtotime($item["date_of_examination_conferment"])),
                    "eligibility_title" => $item["eligibility_title"],
                    "license_date_validity" => Date('Y-m-d', strtotime($item["license_date_validity"])),
                    "license_number" => $item["license_number"],
                    "place_of_examination_conferment" => $item["place_of_examination_conferment"],
                    "rating" => $item["rating"],
                ];
            }, $request->eligibilities);

            $workExperiences = array_map(function ($item) {
                return [
                    "date_from" => Date('Y-m-d', strtotime($item["date_from"])),
                    "date_to" => Date(
                        'Y-m-d',
                        strtotime($item["date_to"])
                    ),
                    "government_service" => $item["government_service"],
                    "monthly_salary" => $item["monthly_salary"],
                    "office_company" => $item["office_company"],
                    "position_title" => $item["position_title"],
                    "salary_grade" => $item["salary_grade"],
                    "status_of_appointment" => $item["status_of_appointment"],
                ];
            }, $request->workExperiences);

            $voluntaryWorks = array_map(function ($item) {
                return [
                    "date_from" => Date('Y-m-d', strtotime($item["date_from"])),
                    "date_to" => Date(
                        'Y-m-d',
                        strtotime($item["date_to"])
                    ),
                    "number_of_hours" => $item["number_of_hours"],
                    "organization_address" => $item["organization_address"],
                    "organization_name" => $item["organization_name"],
                    "position_nature_of_work" => $item["position_nature_of_work"]
                ];
            }, $request->voluntaryWorks);

            $trainings = array_map(function ($item) {
                return [
                    "attendance_from" => Date('Y-m-d', strtotime($item["attendance_from"])),
                    "attendance_to" => Date('Y-m-d', strtotime($item["attendance_to"])),
                    "conducted_sponsored_by" => $item["conducted_sponsored_by"],
                    "number_of_hours" => $item["number_of_hours"],
                    "training_title" => $item["training_title"],
                    "training_type" => $item["training_type"]
                ];
            }, $request->trainings);

            $pds->childrenInformations()->createMany($children);

            // educational background
            $pds->educationalBackgrounds()->createMany($request->schools);


            // eligibilities
            $pds->civilServiceEligibilities()->createMany(
                $eligibilities
            );

            // work experiences
            $pds->workExperiences()->createMany(
                $workExperiences
            );

            // voluntary works
            $pds->voluntaryWorks()->createMany(
                $voluntaryWorks
            );

            // trainings
            $pds->trainingPrograms()->createMany(
                $trainings
            );

            // specialskills
            $pds->specialSkillHobies()->createMany(
                $request->skills
            );

            // recognitions
            $pds->recognitions()->createMany(
                $request->recognitions
            );

            // membership
            $pds->membershipAssociations()->createMany(
                $request->memberships
            );

            // references
            $pds->references()->createMany(
                $request->characterReferences
            );

            // restructure and insert answers
            $answers = array_map(function ($item) use ($familyBackground) {
                return ["question_id" => $item['question_id'], "answer" => $item['answer'], "details" => $item['details']];
            }, $request->answers);

            $pds->answers()->createMany(
                $answers
            );
        }


        // return message
        return $this->success("", "Successfully Saved", 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Applicant $applicant)
    {
        $pds = $applicant->latestPersonalDataSheet;
        $personalInformation = $pds->personalInformation;
        $familyBackground = $pds->familyBackGround;
        $children = $pds->childrenInformations;
        $schools = $pds->educationalBackgrounds;
        $eligibilities = $pds->civilServiceEligibilities;
        $workExperiences = $pds->workExperiences;
        $voluntaryWorks = $pds->voluntaryWorks;
        $trainings = $pds->trainingPrograms;
        $skills = $pds->specialSkillHobies;
        $recognitions = $pds->recognitions;
        $memberships = $pds->membershipAssociations;
        $answers = $pds->answers;
        $characterReferences = $pds->references;


        return compact(
            'applicant',
            'pds',
            'personalInformation',
            'familyBackground',
            'children',
            'schools',
            'eligibilities',
            'workExperiences',
            'voluntaryWorks',
            'trainings',
            'skills',
            'recognitions',
            'memberships',
            'answers',
            'characterReferences'
        );
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreApplicantRequest $request, Applicant $applicant)
    {
        // validate input fields
        $request->validated($request->all());

        // create applicant

        $applicant->update([
            "first_name" => $request->first_name,
            "middle_name" => $request->middle_name,
            "last_name" => $request->last_name,
            "suffix" => $request->suffix,
            "mobile_number" => $request->mobile_number,
            "email_address" => $request->email_address,
        ]);

        $pds =  $applicant->latestPersonalDataSheet;

        // personal Information
        $personalnformation = $pds->personalInformation->update(
            [
                'birth_place' => $request->birth_place,
                'birth_date' => Date('Y-m-d', strtotime($request->birth_date)),
                'age' => $request->age,
                'sex' => $request->sex,
                'height' => $request->height,
                'weight' => $request->weight,
                'citizenship' => $request->citizenship,
                'citizenship_type' => $request->citizenship_type,
                'country' => $request->country,
                'blood_type' => $request->blood_type,
                'civil_status' => $request->civil_status,
                'tin' => $request->tin,
                'gsis' => $request->gsis,
                'pagibig' => $request->pagibig,
                'philhealth' => $request->philhealth,
                'sss' => $request->sss,
                'residential_province' => $request->residential_province,
                'residential_municipality' => $request->residential_municipality,
                'residential_barangay' => $request->residential_barangay,
                'residential_house' => $request->residential_house,
                'residential_subdivision' => $request->residential_subdivision,
                'residential_street' => $request->residential_street,
                'residential_zipcode' => $request->residential_zipcode,
                'permanent_province' => $request->permanent_province,
                'permanent_municipality' => $request->permanent_municipality,
                'permanent_barangay' => $request->permanent_barangay,
                'permanent_house' => $request->permanent_house,
                'permanent_subdivision' => $request->permanent_subdivision,
                'permanent_street' => $request->permanent_street,
                'permanent_zipcode' => $request->permanent_zipcode,
                'telephone' => $request->telephone,
                'mobile_number' => $request->mobile_number,
                'email_address' => $request->email_address
            ]
        );

        // Family background
        $familyBackground = $pds->familyBackGround->update([
            'spouse_first_name' => $request->spouse_first_name,
            'spouse_middle_name' => $request->spouse_middle_name,
            'spouse_last_name' => $request->spouse_last_name,
            'spouse_suffix' => $request->spouse_suffix,
            'spouse_occupation' => $request->spouse_occupation,
            'spouse_employer' => $request->spouse_employer,
            'spouse_employer_address' => $request->spouse_employer_address,
            'spouse_employer_telephone' => $request->spouse_employer_telephone,
            'father_first_name' => $request->father_first_name,
            'father_middle_name' => $request->father_middle_name,
            'father_last_name' => $request->father_last_name,
            'father_suffix' => $request->father_suffix,
            'mother_first_name' => $request->mother_first_name,
            'mother_middle_name' => $request->mother_middle_name,
            'mother_last_name' => $request->mother_last_name,
            'mother_suffix' => $request->mother_suffix,
        ]);

        $familyBackground = $pds->familyBackGround;

        //restructure and  insert children
        $children = array_map(function ($item) use ($familyBackground) {
            return ["number" => $item['number'], "name" => $item['name'], "birthday" => Date('Y-m-d', strtotime($item['birthday'])), "pds_family_background_id" => $familyBackground->id];
        }, $request->children);


        $eligibilities = array_map(function ($item) {
            return [
                "date_of_examination_conferment" => Date('Y-m-d', strtotime($item["date_of_examination_conferment"])),
                "eligibility_title" => $item["eligibility_title"],
                "license_date_validity" => Date('Y-m-d', strtotime($item["license_date_validity"])),
                "license_number" => $item["license_number"],
                "place_of_examination_conferment" => $item["place_of_examination_conferment"],
                "rating" => $item["rating"],
            ];
        }, $request->eligibilities);

        $workExperiences = array_map(function ($item) {
            return [
                "date_from" => Date('Y-m-d', strtotime($item["date_from"])),
                "date_to" => Date('Y-m-d', strtotime($item["date_to"])),
                "government_service" => $item["government_service"],
                "monthly_salary" => $item["monthly_salary"],
                "office_company" => $item["office_company"],
                "position_title" => $item["position_title"],
                "salary_grade" => $item["salary_grade"],
                "status_of_appointment" => $item["status_of_appointment"],
            ];
        }, $request->workExperiences);

        $voluntaryWorks = array_map(function ($item) {
            return [
                "date_from" => Date('Y-m-d', strtotime($item["date_from"])),
                "date_to" => Date('Y-m-d', strtotime($item["date_to"])),
                "number_of_hours" => $item["number_of_hours"],
                "organization_address" => $item["organization_address"],
                "organization_name" => $item["organization_name"],
                "position_nature_of_work" => $item["position_nature_of_work"]
            ];
        }, $request->voluntaryWorks);

        $trainings = array_map(function ($item) {
            return [
                "attendance_from" => Date('Y-m-d', strtotime($item["attendance_from"])),
                "attendance_to" => Date('Y-m-d', strtotime($item["attendance_to"])),
                "conducted_sponsored_by" => $item["conducted_sponsored_by"],
                "number_of_hours" => $item["number_of_hours"],
                "training_title" => $item["training_title"],
                "training_type" => $item["training_type"]
            ];
        }, $request->trainings);

        $pds->childrenInformations()->forceDelete();
        $pds->childrenInformations()->createMany($children);



        // educational background
        $pds->educationalBackgrounds()->forceDelete();
        $pds->educationalBackgrounds()->createMany($request->schools);


        // eligibilities
        $pds->civilServiceEligibilities()->forceDelete();
        $pds->civilServiceEligibilities()->createMany(
            $eligibilities
        );

        // work experiences
        $pds->workExperiences()->forceDelete();
        $pds->workExperiences()->createMany(
            $workExperiences
        );

        // voluntary works
        $pds->voluntaryWorks()->forceDelete();
        $pds->voluntaryWorks()->createMany(
            $voluntaryWorks
        );

        // trainings
        $pds->trainingPrograms()->forceDelete();
        $pds->trainingPrograms()->createMany(
            $trainings
        );

        // specialskills
        $pds->specialSkillHobies()->forceDelete();
        $pds->specialSkillHobies()->createMany(
            $request->skills
        );

        // recognitions
        $pds->recognitions()->forceDelete();
        $pds->recognitions()->createMany(
            $request->recognitions
        );

        // membership
        $pds->membershipAssociations()->forceDelete();
        $pds->membershipAssociations()->createMany(
            $request->memberships
        );

        // references
        $pds->references()->forceDelete();
        $pds->references()->createMany(
            $request->characterReferences
        );

        // restructure and insert answers
        $answers = array_map(function ($item) use ($familyBackground) {
            return ["question_id" => $item['question_id'], "answer" => $item['answer'], "details" => $item['details']];
        }, $request->answers);

        $pds->answers()->forceDelete();
        $pds->answers()->createMany(
            $answers
        );


        // return message
        return $this->success("", "Successfully Saved", 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicant $applicant)
    {
        $applicant->personalDataSheets()->delete();
        $applicant->delete();
        return $this->success("", "Successfully Deleted", 200);
    }
}
