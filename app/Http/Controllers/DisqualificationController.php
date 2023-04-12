<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Notice;
use App\Models\Assessment;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\Disqualification;
use App\Http\Resources\DisqualificationResource;
use App\Http\Requests\StoreDisqualificationRequest;

class DisqualificationController extends Controller
{

    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DisqualificationResource::collection(
            Disqualification::with('belongsToApplication.hasOneNotice')->get()
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
    public function store(StoreDisqualificationRequest $request)
    {
        $request->validated($request->all());

        $noticeExist = Notice::where('application_id',$request->application_id)->exists();
        if($noticeExist){
            return $this->error('', 'Duplicate Entry', 200);
        }
        

        $status = 'Disqualified';
        $today = Carbon::today()->toDateString();

        $disqualificationExist = Disqualification::where([
            ['application_id', $request->application_id]
        ])->exists();
        if ($disqualificationExist) {
            return $this->error('', 'Duplicate Entry', 400);
        }

        Disqualification::create([
            "application_id" => $request->application_id,
            "date_disqualified" => $request->date_disqualified,
            "reason" => $request->reason
        ]);

        Application::where('id', $request->application_id)
            ->update(['status' => $status]);

        if ($request->training && $request->performance && $request->education && $request->experience != null) {
            Assessment::create([
                "application_id" => $request->application_id,
                "member_id" => $request->member_id,
                "training" => $request->training,
                "performance" => $request->performance,
                "education" => $request->education,
                "experience" => $request->experience,
                "date_of_assessment" => $today
            ]);
        }

        return $this->success('', 'Successfully Disqualified', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Disqualification $disqualification)
    {
        return (new DisqualificationResource($disqualification->loadMissing(['belongsToApplication'])));
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
    public function update(Request $request, Disqualification $disqualification)
    {   

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disqualification $disqualification)
    {
        $disqualification->delete();
        return $this->success('', 'Successfully Deleted', 200);
    }

    public function reverseDisqualification(Disqualification $disqualification)
    {
        
        $status = 'New';

        $application = Application::where('id', $disqualification->application_id)->first();
        $application->status = $status;
        
       
        //finds the assessment and delete
        $assessment = Assessment::where('application_id',$disqualification->application_id);  
        // dd($assessment);
        if($assessment != null){
        $assessment->delete();
        }
        
        //Deletes the record 
        $disqualification->delete();

        $application->save();

        return $this->success('','Successfully Reversed',200);
    }
}
