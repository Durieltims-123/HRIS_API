<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\SalaryGrade;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Requests\StoreRequest;
use App\Models\QualificationStandard;
use App\Http\Resources\PositionResource;
use App\Http\Requests\StorePositionRequest;
use App\Http\Resources\SalaryGradeResource;
use App\Http\Resources\QualificationStandardResource;
use App\Http\Requests\StoreQualificationStandardRequest;

class PositionController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return PositionResource::collection(
            Position::with('hasManyQualificationStandard', 'belongsToSalaryGrade')->get()
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
    public function store(StorePositionRequest $request)
    {
            // validate input fields
            $request->validated($request->all());

            // validate user from database

            // $positionExist = Position::where('title', $request->title);

            // if ($positionExist) {
            //     return $this->error('', 'Duplicate Entry', 400);
            // }
    

            $positionQS = Position::create([
                "title" => $request->title,
                "salary_grade_id" => $request->salary_grade_id

            ]);
            
            QualificationStandard::create([
                'position_id' => $positionQS->id,
                "education" => $request->education,
                "training" => $request->training,
                "experience" => $request->experience,
                "eligibility" => $request->eligibility,
                "competency" => $request->competency,

                
            ]);

            // $position=new Position();
            // $position-> title=$request->title;
            // $position->save();
           
    
    
            // return message
            return $this->success('', 'Successfull Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        return PositionResource::collection(
            Position::where('id', $position->id)
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
    public function update(StorePositionRequest $request, Position $position)
    {
    
        // $positionId =  Position::where('title', $request->position_title)->pluck('id')->first();
            $position->title = $request->title;
            $position->salary_grade_id = $request->salary_grade_id;

            $qualificationStandard = QualificationStandard::where('position_id',$position->id);
            $qualificationStandard->education = $request->education;
            $qualificationStandard->training = $request->training;
            $qualificationStandard->experience = $request->experience;
            $qualificationStandard->eligibility = $request->eligibility;
            $qualificationStandard->competency = $request->competency   ;

            $position->save();
            // $qualificationStandard->save();

            return new PositionResource($position);

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Position $position, QualificationStandard $qualificationStandard)
    {

        $position->delete();
        //    $qualificationStandard->delete();
        return $this->success('', 'Successfull Deleted', 200);
    }

    public function search(Request $request)
    {

        // dd(Position::where('title', 'like', '%'.$request->keyword.'%')
        // ->with(['hasManyQualificationStandard','belongsToSalaryGrade'])
        // ->limit(10)
        // ->get());
        return PositionResource::collection(
            Position::where('title', 'like', '%' . $request->keyword . '%')
                ->with(['hasManyQualificationStandard', 'belongsToSalaryGrade'])
                ->limit(10)
                ->get()
        );
    }
}
