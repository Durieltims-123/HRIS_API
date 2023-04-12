<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInterviewRequest;
use App\Http\Resources\InterviewResource;
use App\Http\Resources\VacancyResource;
use App\Models\Interview;
use App\Models\PublicationInterview;
use App\Traits\HttpResponses;
use Faker\Provider\ar_EG\Internet;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return InterviewResource::collection(
            Interview::with('publicationInterview.belongsToPublication.hasOneApplication')->get()
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
    public function store(StoreInterviewRequest $request)
    {
        $request->validated($request->all());

        $interview = Interview::create([
            'interview_date' => $request->interview_date,
            'venue' => $request->venue,
        ]);

        $publication_ids = $request->input('publication_id');
        foreach($publication_ids as $i => $publication_id){
            PublicationInterview::create([
                'publication_id' => $publication_id, //Accepts array of publication ID based on selected interviewees
                'interview_id' => $interview->id
            ]);
        }
        

        return $this->success('','Successfully Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Interview $interview)
    {
        return new InterviewResource($interview->loadMissing(['publicationInterview.belongsToPublication.hasOneApplication']));
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
    public function update(Request $request, Interview $interview)
    {
        $interview->interview_date = $request->interview_date;
        $interview->venue = $request->venue;
        $interview->save();

        return new InterviewResource($interview);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interview $interview)
    {
        $interview->delete();

        return $this->success('','Successfully Deleted',200);
    }
}
