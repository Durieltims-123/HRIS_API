<?php

namespace App\Http\Controllers;

use App\Models\LguPosition;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\DB;
use App\Models\PositionDescription;
use App\Http\Resources\LguPositionResource;
use App\Http\Requests\StoreLguPositionRequest;

class LguPositionController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $plantilla = LguPosition::with(['hasOneVacancy'])->get();

        return LguPositionResource::collection($plantilla);
        //    return $plantilla->mapInto(VacancyResource::class);
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
    public function store(StoreLguPositionRequest $request)
    {
        $request->validated($request->all());

        $plantillaExist = LguPosition::where('item_number', $request->item_number)->exists();
        if ($plantillaExist) {
            return $this->error('', 'Duplicate Entry', 400);
        }

        $plantilla = LguPosition::create([
            'office_id' => $request->office_id,
            'position_id' => $request->position_id,
            'item_number' => $request->item_number,
            "place_of_assignment" => $request->place_of_assignment,
            "year" => $request->year
        ]);

        PositionDescription::create([
            'lgu_position_id' => $plantilla->id,
            'description' => $request->description
        ]);


        // return message
        return $this->success('', 'Successfully Saved', 200);
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
    public function update(Request $request, LguPosition $plantilla)
    {
        $plantilla->item_number = $request->item_number;
        $plantilla->place_of_assignment = $request->place_of_assignment;
        $plantilla->year = $request->year;
        $plantilla->save();

        PositionDescription::where('lgu_position_id', $plantilla->id)
            ->update([
                'lgu_position_id' => $plantilla->id,
                'description' => $request->description
            ]);

        return new LguPositionResource($plantilla);
    }

    public function search(Request $request)
    {
        $activePage = $request->activePage;
        $status = $request->status;
        // initial test
        $status = "Active";
        $searchKeyword = $request->searchKeyword;
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $year = $request->year;
        $positionStatus = $request->positionStatus;

        $orderAscending  ? $orderAscending = "asc" : $orderAscending = "desc";
        $searchKeyword == null ? $searchKeyword = "" : $searchKeyword = $searchKeyword;
        ($orderBy == null || $orderBy == "id") ? $orderBy = "lgu_positions.id" : $orderBy = $orderBy;

        $data = LguPositionResource::collection(
            LguPosition::join('positions', 'positions.id', 'lgu_positions.position_id')
                ->join('offices', 'lgu_positions.office_id', 'offices.id')
                ->join('departments', 'departments.id', 'offices.department_id')
                ->join('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
                ->join('qualification_standards', 'positions.id', 'qualification_standards.position_id')
                ->join('position_descriptions', 'lgu_positions.id', 'position_descriptions.lgu_position_id')
                // ->where([
                //     ["lgu_positions.id", "like", "%" . $searchKeyword . "%"], ["lgu_positions.year", "like", $year . "%"],
                //     [DB::RAW('position_status IN (' . $positionStatus . ')')]
                // ])
                // ->orWhere([
                //     ["positions.title", "like", "%" . $searchKeyword . "%"], ["lgu_positions.year", "like", $year . "%"],
                //     [DB::RAW('position_status IN (' . $positionStatus . ')')]
                // ])
                // ->orWhere([
                //     ["lgu_positions.item_number", "like", "%" . $searchKeyword . "%"], ["lgu_positions.year", "like", $year . "%"],
                //     [DB::RAW('position_status IN (' . $positionStatus . ')')]
                // ])
                // ->orWhere([
                //     ["qualification_standards.education", "like", "%" . $searchKeyword . "%"], ["lgu_positions.year", "like", $year . "%"],
                //     [DB::RAW('position_status IN (' . $positionStatus . ')')]
                // ])
                // ->orWhere([
                //     ["qualification_standards.eligibility", "like", "%" . $searchKeyword . "%"], ["lgu_positions.year", "like", $year . "%"],
                //     [DB::RAW('position_status IN (' . $positionStatus . ')')]
                // ])
                // ->orWhere([
                //     ["qualification_standards.training", "like", "%" . $searchKeyword . "%"], ["lgu_positions.year", "like", $year . "%"],
                //     [DB::RAW('position_status IN (' . $positionStatus . ')')]
                // ])
                // ->orWhere([
                //     ["qualification_standards.experience", "like", "%" . $searchKeyword . "%"], ["lgu_positions.year", "like", $year . "%"],
                //     [DB::RAW('position_status IN (' . $positionStatus . ')')]
                // ])
                // ->orWhere([
                //     ["position_descriptions.description", "like", "%" . $searchKeyword . "%"], ["lgu_positions.year", "like", $year . "%"],
                //     [DB::RAW('position_status IN (' . $positionStatus . ')')]
                // ])
                ->skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->take(10)
                ->get()
        );
        $pages =
            LguPosition::select("*", 'lgu_positions.id')
            ->join('positions', 'positions.id', 'lgu_positions.position_id')
            ->join('offices', 'lgu_positions.office_id', 'offices.id')
            ->join('departments', 'departments.id', 'offices.department_id')
            ->join('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
            ->join('qualification_standards', 'positions.id', 'qualification_standards.position_id')
            ->join('position_descriptions', 'lgu_positions.id', 'position_descriptions.lgu_position_id')
            // ->where([
            //     ["lgu_positions.id", "like", "%" . $searchKeyword . "%"], ["lgu_positions.year", "like", $year . "%"],
            //     [DB::RAW('position_status IN (' . $positionStatus . ')')]
            // ])
            // ->orWhere([
            //     ["positions.title", "like", "%" . $searchKeyword . "%"], ["lgu_positions.year", "like", $year . "%"],
            //     [DB::RAW('position_status IN (' . $positionStatus . ')')]
            // ])
            // ->orWhere([
            //     ["lgu_positions.item_number", "like", "%" . $searchKeyword . "%"], ["lgu_positions.year", "like", $year . "%"],
            //     [DB::RAW('position_status IN (' . $positionStatus . ')')]
            // ])
            // ->orWhere([
            //     ["qualification_standards.education", "like", "%" . $searchKeyword . "%"], ["lgu_positions.year", "like", $year . "%"],
            //     [DB::RAW('position_status IN (' . $positionStatus . ')')]
            // ])
            // ->orWhere([
            //     ["qualification_standards.eligibility", "like", "%" . $searchKeyword . "%"], ["lgu_positions.year", "like", $year . "%"],
            //     [DB::RAW('position_status IN (' . $positionStatus . ')')]
            // ])
            // ->orWhere([
            //     ["qualification_standards.training", "like", "%" . $searchKeyword . "%"], ["lgu_positions.year", "like", $year . "%"],
            //     [DB::RAW('position_status IN (' . $positionStatus . ')')]
            // ])
            // ->orWhere([
            //     ["qualification_standards.experience", "like", "%" . $searchKeyword . "%"], ["lgu_positions.year", "like", $year . "%"],
            //     [DB::RAW('position_status IN (' . $positionStatus . ')')]
            // ])
            // ->orWhere([
            //     ["position_descriptions.description", "like", "%" . $searchKeyword . "%"], ["lgu_positions.year", "like", $year . "%"],
            //     [DB::RAW('position_status IN (' . $positionStatus . ')')]
            // ])
            ->count();

        return compact('pages', 'data', 'positionStatus');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LguPosition $plantilla)
    {
        $plantilla->delete();
        return $this->success('', 'Successfully Deleted', 200);
    }
}
