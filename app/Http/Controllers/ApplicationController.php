<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Http\Resources\ApplicationResource;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\Division;
use App\Models\Employee;
use App\Models\LguPosition;
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
            Application::all()
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
            "suffix" => $request->suffix,
            "application_type" => $request->application_type,
            "status" => 'New'
        ]);

        return $this->success('', 'Successfully Saved.', 200);
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
        $application->suffix = $request->suffix;
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
        return $this->success('', 'Successfully Deleted', 200);
    }


    public function searchPerson(Request $request)
    {
        $details = null;
        $filters = [];


        // format filters
        if ($request->suffix != "") {
            $filters = [
                ['employee_id', "like", "%" . $request->employee_id . "%"],
                ['first_name', "like", "%" . $request->first_name . "%"],
                ['middle_name', "like", "%" . $request->middle_name . "%"],
                ['last_name', "like", "%" . $request->last_name . "%"],
                ['suffix', "like", "%" . $request->suffix . "%"]
            ];
        } else {
            $filters =   [
                ['employee_id', "like", "%" . $request->employee_id . "%"],
                ['first_name', "like", "%" . $request->first_name . "%"],
                ['middle_name', "like", "%" . $request->middle_name . "%"],
                ['last_name', "like", "%" . $request->last_name . "%"]
            ];
        }

        // check middlename if has data
        if ($request->middle_name != "") {
            unset($filters[2]);
        }

        // check if employee exists
        $employee = Employee::where($filters)->latest()->first();


        if ($employee != null) {
            $details = Employee::find($employee->id);
            $pds = $details->latestPersonalDataSheet;
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
            $division = Division::find($employee->division_id);
            $lguPositionData = LguPosition::find($employee->lgu_position_id);
            $lguPosition = $lguPositionData->position->title . '-' . $lguPositionData->item_number;
        } else {
            unset($filters[0]);

            $applicant = Applicant::where($filters)->latest()->first();

            if ($applicant != null) {
                $details = Applicant::find($applicant->id);
                $pds = $details->latestPersonalDataSheet;
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
                $division = "";
                $lguPositionData = "";
                $lguPosition = "";
            }
        }

        if ($details != null) {
            return compact(
                'details',
                'pds',
                'division',
                'lguPosition',
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
        } else {
            return [];
        }
    }
}
