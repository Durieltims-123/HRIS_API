<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssessmentRequest;
use App\Http\Resources\AssessmentResource;
use App\Models\Assessment;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AssessmentResource::collection(
            Assessment::all()
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
    public function store(StoreAssessmentRequest $request)
    {
        $request->validate($request->all());

        $assessmentExists = Assessment::where('application_id', $request->application_id)->exists();
        if($assessmentExists){
            return $this->error('', 'Duplicate Entry', 200);
        }

        $member_ids = $request->input('member_id');
        $trainings = $request->input('training');
        $performances = $request->input('performance');
        $educations = $request->input('education');
        $experiences = $request->input('experience'); 
        $psychological_attributes = $request->input('psychological_attribute');
        $potentials = $request->input('potential');
        $awards = $request->input('awards');
        $additional_informations = $request->input('additional_information');
        $remarks = $request->input('remarks');
        $date_of_assessments = $request->input('date_of_assessment');

        foreach($member_ids as $i => $member_id){
            Assessment::create([
                "application_id" => $request->application_id,
                "member_id" => $member_id,
                "training" => $trainings[$i],
                "performance" => $performances[$i],
                "education" => $educations[$i],
                "experience" => $experiences[$i],
                "psychological_attribute" => $psychological_attributes[$i],
                "potential" => $potentials[$i],
                "awards" => $awards[$i],
                "additional_information" => $additional_informations[$i],
                "remarks" => $remarks[$i],
                "date_of_assessment" => $date_of_assessments[$i],
            ]);
        }

        return $this->success('', 'Successfull Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Assessment $assessment)
    {
        return AssessmentResource::collection(
            Assessment::where('id', $assessment->id)->get()
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
    public function update(Request $request, Assessment $assessment)
    {
       
        $member_ids = $request->input('member_id');
        $trainings = $request->input('training');
        $performances = $request->input('performance');
        $educations = $request->input('education');
        $experiences = $request->input('experience'); 
        $psychological_attributes = $request->input('psychological_attribute');
        $potentials = $request->input('potential');
        $awards = $request->input('awards');
        $additional_informations = $request->input('additional_information');
        $remarks = $request->input('remarks');
        $date_of_assessments = $request->input('date_of_assessment');

     
      
        foreach($member_ids as $i => $member_id){
           
            Assessment::where([['member_id',$member_id],['application_id',$request->application_id]])
            ->update([
                'application_id' => $request->application_id,
                'member_id' => $member_id,
                'training' => $trainings[$i],
                'performance' => $performances[$i],
                'education' => $educations[$i],
                'experience' => $experiences[$i],
                'psychological_attribute' => $psychological_attributes[$i],
                'potential' => $potentials[$i],
                'awards' => $awards[$i],
                'additional_information' => $additional_informations[$i],
                'remarks' => $remarks[$i],
                'date_of_assessment' => $date_of_assessments[$i],
            
            ]);
        }

        return new AssessmentResource($assessment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assessment $assessment)
    {
        $assessment->delete();

        return $this->success('','Successfully Deleted', 200);
    }
}
