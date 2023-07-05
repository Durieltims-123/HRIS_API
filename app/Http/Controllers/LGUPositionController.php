<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
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

        $lguPosition = LguPosition::with(['hasOneVacancy'])->get();

        return LguPositionResource::collection($lguPosition);
        //    return $lguPosition->mapInto(VacancyResource::class);
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

        $lguPositionExist = LguPosition::where([['item_number', $request->item_number], ['position_status', $request->position_status]])->exists();
        if ($lguPositionExist) {
            return $this->error('', 'Duplicate Entry', 400);
        }

        $lguPosition = LguPosition::create([
            'office_id' => $request->office_id,
            'position_id' => $request->position_id,
            'item_number' => $request->item_number,
            'place_of_assignment' => $request->place_of_assignment,
            'year' => (int) date('Y', strtotime($request->year)),
            'status' => $request->status,
            'position_status' => $request->position_status
        ]);

        PositionDescription::create([
            'lgu_position_id' => $lguPosition->id,
            'description' => $request->description
        ]);


        // return message
        return $this->success('', 'Successfully Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(LguPosition $lguPosition)
    {
        return new LguPositionResource(
            LguPosition::join('positions', 'positions.id', 'lgu_positions.position_id')
                ->join('offices', 'lgu_positions.office_id', 'offices.id')
                ->join('departments', 'departments.id', 'offices.department_id')
                ->join('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
                ->join('qualification_standards', 'positions.id', 'qualification_standards.position_id')
                ->leftJoin('position_descriptions', 'lgu_positions.id', 'position_descriptions.lgu_position_id')
                ->where('lgu_position_id', $lguPosition->id)
                ->first()
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
    public function update(Request $request, LguPosition $lguPosition)
    {

        $lguPosition->office_id = $request->office_id;
        $lguPosition->position_id = $request->position_id;
        $lguPosition->item_number = $request->item_number;
        $lguPosition->place_of_assignment = $request->place_of_assignment;
        $lguPosition->year = (int) date('Y', strtotime($request->year));
        $lguPosition->status = $request->status;
        $lguPosition->position_status = $request->position_status;
        $lguPosition->save();

        PositionDescription::where('lgu_position_id', $lguPosition->id)
            ->update([
                'description' => $request->description
            ]);

        return new LguPositionResource($lguPosition);
    }

    public function search(Request $request)
    {
        $activePage = $request->activePage;
        $status = $request->status;
        // initial test
        $searchKeyword = $request->searchKeyword;
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $year = $request->year;
        $positionStatus = implode('","', $request->positionStatus);
        $status = implode('","', $request->status);
        $viewAll = $request->viewAll;


        $orderAscending  ? $orderAscending = 'asc' : $orderAscending = 'desc';
        $searchKeyword == null ? $searchKeyword = '' : $searchKeyword = $searchKeyword;
        ($orderBy == null || $orderBy == 'id') ? $orderBy = 'lgu_positions.id' : $orderBy = $orderBy;

        $rawData = LguPosition::select('*', 'lgu_positions.id')
            ->join('positions', 'positions.id', 'lgu_positions.position_id')
            ->join('offices', 'lgu_positions.office_id', 'offices.id')
            ->join('departments', 'departments.id', 'offices.department_id')
            ->join('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
            ->join('qualification_standards', 'positions.id', 'qualification_standards.position_id')
            ->leftJoin('position_descriptions', 'lgu_positions.id', 'position_descriptions.lgu_position_id')
            ->whereRaw('lgu_positions.id LIKE "%' . $searchKeyword . '%" AND lgu_positions.year LIKE "' . $year . '%" AND position_status IN ("' . $positionStatus . '") AND status IN ("' . $status . '")')
            ->orWhereRaw('positions.title LIKE "%' . $searchKeyword . '%" AND lgu_positions.year LIKE "' . $year . '%" AND position_status IN ("' . $positionStatus . '") AND status IN ("' . $status . '")')
            ->orWhereRaw('lgu_positions.item_number LIKE "%' . $searchKeyword . '%" AND lgu_positions.year LIKE "' . $year . '%" AND position_status IN ("' . $positionStatus . '") AND status IN ("' . $status . '")')
            ->orWhereRaw('qualification_standards.education LIKE "%' . $searchKeyword . '%" AND lgu_positions.year LIKE "' . $year . '%" AND position_status IN ("' . $positionStatus . '") AND status IN ("' . $status . '")')
            ->orWhereRaw('qualification_standards.eligibility LIKE "%' . $searchKeyword . '%" AND lgu_positions.year LIKE "' . $year . '%" AND position_status IN ("' . $positionStatus . '") AND status IN ("' . $status . '")')
            ->orWhereRaw('qualification_standards.training LIKE "%' . $searchKeyword . '%" AND lgu_positions.year LIKE "' . $year . '%" AND position_status IN ("' . $positionStatus . '") AND status IN ("' . $status . '")')
            ->orWhereRaw('qualification_standards.experience LIKE "%' . $searchKeyword . '%" AND lgu_positions.year LIKE "' . $year . '%" AND position_status IN ("' . $positionStatus . '") AND status IN ("' . $status . '")')
            ->orWhereRaw('position_descriptions.description LIKE "%' . $searchKeyword . '%" AND lgu_positions.year LIKE "' . $year . '%" AND position_status IN ("' . $positionStatus . '") AND status IN ("' . $status . '")')
            ->orderBy($orderBy, $orderAscending);



        if ($viewAll) {
            $rawData = $rawData->get();
        } else {
            $rawData = $rawData->skip(($activePage - 1) * 10)->take(10)->get();
        }

        $data = LguPositionResource::collection($rawData);
        $pages = LguPosition::select('*', 'lgu_positions.id')
            ->join('positions', 'positions.id', 'lgu_positions.position_id')
            ->join('offices', 'lgu_positions.office_id', 'offices.id')
            ->join('departments', 'departments.id', 'offices.department_id')
            ->join('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
            ->join('qualification_standards', 'positions.id', 'qualification_standards.position_id')
            ->leftJoin('position_descriptions', 'lgu_positions.id', 'position_descriptions.lgu_position_id')
            ->whereRaw('lgu_positions.id LIKE "%' . $searchKeyword . '%" AND lgu_positions.year LIKE "' . $year . '%" AND position_status IN ("' . $positionStatus . '") AND status IN ("' . $status . '")')
            ->orWhereRaw('positions.title LIKE "%' . $searchKeyword . '%" AND lgu_positions.year LIKE "' . $year . '%" AND position_status IN ("' . $positionStatus . '") AND status IN ("' . $status . '")')
            ->orWhereRaw('lgu_positions.item_number LIKE "%' . $searchKeyword . '%" AND lgu_positions.year LIKE "' . $year . '%" AND position_status IN ("' . $positionStatus . '") AND status IN ("' . $status . '")')
            ->orWhereRaw('qualification_standards.education LIKE "%' . $searchKeyword . '%" AND lgu_positions.year LIKE "' . $year . '%" AND position_status IN ("' . $positionStatus . '") AND status IN ("' . $status . '")')
            ->orWhereRaw('qualification_standards.eligibility LIKE "%' . $searchKeyword . '%" AND lgu_positions.year LIKE "' . $year . '%" AND position_status IN ("' . $positionStatus . '") AND status IN ("' . $status . '")')
            ->orWhereRaw('qualification_standards.training LIKE "%' . $searchKeyword . '%" AND lgu_positions.year LIKE "' . $year . '%" AND position_status IN ("' . $positionStatus . '") AND status IN ("' . $status . '")')
            ->orWhereRaw('qualification_standards.experience LIKE "%' . $searchKeyword . '%" AND lgu_positions.year LIKE "' . $year . '%" AND position_status IN ("' . $positionStatus . '") AND status IN ("' . $status . '")')
            ->orWhereRaw('position_descriptions.description LIKE "%' . $searchKeyword . '%" AND lgu_positions.year LIKE "' . $year . '%" AND position_status IN ("' . $positionStatus . '") AND status IN ("' . $status . '")')
            ->count();

        return compact('pages', 'data');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LguPosition $lguPosition)
    {
        $lguPositionExist = Vacancy::where([['lgu_position_id', $lguPosition->id]])
            ->exists();
        if ($lguPositionExist) {
            return $this->error('', 'You cannot delete Data connected to Vacancies.', 400);
        } else {
            PositionDescription::where('lgu_position_id', $lguPosition->id)->delete();
            $lguPosition->delete();
            return $this->success('', 'Successfully Deleted', 200);
        }
    }
}
