<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQualificationStandardRequest;
use App\Http\Resources\QualificationStandardResource;
use App\Models\QualificationStandard;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class QualificationStandardController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return 'yes';
        return QualificationStandardResource::collection(
            QualificationStandard::all()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return $request;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQualificationStandardRequest $request)
    {
        $request->validated($request->all());

        // validate user from database
        $qualificationStandardExist = QualificationStandard::where([['education', $request->education],
         ['training', $request->training], ['experience', $request->experience],
         ['eligibility', $request->eligibility], ['competency', $request->competency]])->exists();

        if ($qualificationStandardExist) {
            return $this->error('', 'Duplicate Entry', 400);
        }
        // dd($request);
        QualificationStandard::create([
            "education" => $request->education,
            "training" => $request->training,
            "experience" => $request->experience,
            "eligibility" => $request->eligibility,
            "competency" => $request->competency,
        ]);


        // return message
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
    public function update(Request $request, QualificationStandard $qualificationStandard)
    {
    
            
         $qualificationStandard->education = $request->education;
         $qualificationStandard->training = $request->training;
         $qualificationStandard->experience = $request->experience;
         $qualificationStandard->eligibility = $request->eligibility;
         $qualificationStandard->competency = $request->competency;
         $qualificationStandard->save();
        
                // $holiday->update($request->all());
                return new QualificationStandardResource($qualificationStandard);
            
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QualificationStandard $qualificationStandard)
    {

        $qualificationStandard->delete(); 
        return $this->success('', 'Successfull Deleted', 200);
        
    }
}
