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
use App\Models\LguPosition;

class PositionController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PositionResource::collection(
            Position::select(
                "title",
                "positions.id",
                "salary_grades.number",
                "salary_grades.amount",
                "qualification_standards.education",
                "qualification_standards.training",
                "qualification_standards.experience",
                "qualification_standards.eligibility",
                "qualification_standards.competency"
            )
                ->join("qualification_standards", "qualification_standards.position_id", "positions.id")
                ->join("salary_grades", "salary_grades.id", "positions.salary_grade_id")
                ->orderBy('title', 'asc')
                ->get()
        )->toJson();
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
        $positionExist = Position::where('title', $request->title)->exists();

        if ($positionExist) {
            return $this->error('', 'Duplicate Entry', 400);
        } else {


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
            // return message
            return $this->success('', 'Successfully Saved', 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        return
            Position::where("positions.id", $position->id)
            ->select(
                "title",
                "positions.id",
                "salary_grades.id as salary_grade_id",
                "salary_grades.number",
                "salary_grades.amount",
                "qualification_standards.education",
                "qualification_standards.training",
                "qualification_standards.experience",
                "qualification_standards.eligibility",
                "qualification_standards.competency"
            )
            ->join("qualification_standards", "qualification_standards.position_id", "positions.id")
            ->join("salary_grades", "salary_grades.id", "positions.salary_grade_id")
            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePositionRequest $request, Position $position)
    {
        $position->title = $request->title;
        $position->salary_grade_id = $request->salary_grade_id;
        $qs = QualificationStandard::where('position_id', $position->id)->orderBy('id', "desc")->first();
        $qualificationStandard = QualificationStandard::find($qs->id);
        $qualificationStandard->education = $request->education;
        $qualificationStandard->training = $request->training;
        $qualificationStandard->experience = $request->experience;
        $qualificationStandard->eligibility = $request->eligibility;
        $qualificationStandard->competency = $request->competency;
        $position->save();
        $qualificationStandard->save();

        return new PositionResource($position);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Position $position, QualificationStandard $qualificationStandard)
    {
        $lguPositionExist = LguPosition::where([['position_id', $position->id]])
            ->exists();
        if ($lguPositionExist) {
            return $this->error('', 'You cannot delete Position with existing LguPosition.', 400);
        } else {
            $position->delete();
            //    $qualificationStandard->delete();
            return $this->success('', 'Successfully Deleted', 200);
        }
    }

    public function search(Request $request)
    {

        $activePage = $request->activePage;
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $orderAscending  ? $orderAscending = "asc" : $orderAscending = "desc";
        $orderBy == null ? $orderBy = "id" : $orderBy = $orderBy;
        $filters = $request->filters;
        if (count($filters) > 0) {
            $filters =  array_map(function ($filter) {
                if ($filter['column'] === "id") {
                    return ['positions.id', 'like', '%' . $filter['value'] . '%'];
                } else {
                    return [$filter['column'], 'like', '%' . $filter['value'] . '%'];
                }
            }, $filters);
        } else {
            $filters = [['positions.id', 'like', '%']];
        }

        $data = PositionResource::collection(
            Position::select(
                "title",
                "positions.id",
                "salary_grades.number",
                "salary_grades.amount",
                "qualification_standards.education",
                "qualification_standards.training",
                "qualification_standards.experience",
                "qualification_standards.eligibility",
                "qualification_standards.competency"
            )
                ->join("qualification_standards", "qualification_standards.position_id", "positions.id")
                ->join("salary_grades", "salary_grades.id", "positions.salary_grade_id")
                ->where($filters)
                ->skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->limit(10)
                ->get()
        );

        $pages = Position::select(
            "title",
            "positions.id",
            "salary_grades.number",
            "salary_grades.amount",
            "qualification_standards.education",
            "qualification_standards.training",
            "qualification_standards.experience",
            "qualification_standards.eligibility",
            "qualification_standards.competency"
        )
            ->join("qualification_standards", "qualification_standards.position_id", "positions.id")
            ->join("salary_grades", "salary_grades.id", "positions.salary_grade_id")
            ->where($filters)
            ->count();

        return compact('pages', 'data');
    }
}
