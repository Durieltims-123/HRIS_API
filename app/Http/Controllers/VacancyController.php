<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Resources\VacancyResource;
use App\Http\Requests\StoreVacancyRequest;

class VacancyController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return VacancyResource::collection(
            Vacancy::with([
                'belongsToLguPosition.belongsToPosition',
                'belongsToLguPosition.belongsToPosition.belongsToSalaryGrade',
                'belongsToLguPosition.belongsToPosition.hasManyQualificationStandard',
            ])->get()
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
    public function store(StoreVacancyRequest $request)
    {

        $request->validated($request->all());

        $vacancyExist = Vacancy::where([
            ['date_submitted', Date('Y-m-d', strtotime($request->date_submitted))],
            ['date_queued', Date('Y-m-d', strtotime($request->date_queued))],
            ['date_approved', Date('Y-m-d', strtotime($request->date_approved))],
            ['status', $request->status]
        ])->exists();
        if ($vacancyExist) {
            return $this->error('', 'Duplicate Entry', 400);
        }

        Vacancy::create([
            'lgu_position_id' => $request->lgu_position_id,
            'date_submitted' => Date('Y-m-d', strtotime($request->date_submitted)),
            'date_queued' => Date('Y-m-d', strtotime($request->date_queued)),
            'date_approved' => Date('Y-m-d', strtotime($request->date_approved)),
            'status' => $request->status
        ]);

        // return message
        return $this->success('', 'Successfully Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacancy $vacancy)
    {
        return (new VacancyResource($vacancy->loadMissing(['belongsToLguPosition.belongsToPosition'])));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return VacancyResource::collection(
            Vacancy::all()
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vacancy $vacancy)
    {

        $vacancy->date_submitted = Date('Y-m-d', strtotime($request->date_submitted));
        $vacancy->date_queued = Date('Y-m-d', strtotime($request->date_queued));
        $vacancy->date_approved = Date('Y-m-d', strtotime($request->date_approved));
        $vacancy->status = $request->status;

        $vacancy->save();

        return new VacancyResource($vacancy);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacancy $vacancy)
    {
        $vacancy->delete();
        return $this->success('', 'Successfully Deleted', 200);
    }

    public function vacancyQueue(Vacancy $vacancy)
    {

        $today = Carbon::today()->toDateString();

        Vacancy::where('id', $vacancy->id)
            ->update([
                "date_queued" => $today,
                "status" => "Queued"
            ]);

        return $this->success('', 'Successfully Queued Vacancy', 200);
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
        $orderAscending  ? $orderAscending = "asc" : $orderAscending = "desc";
        $searchKeyword == null ? $searchKeyword = "" : $searchKeyword = $searchKeyword;
        ($orderBy == null || $orderBy == "id") ? $orderBy = "vacancies.id" : $orderBy = $orderBy;

        $data = VacancyResource::collection(
            Vacancy::select("*", 'vacancies.id')
                ->join('lgu_positions', 'lgu_positions.id', 'vacancies.lgu_position_id')
                ->join('positions', 'positions.id', 'lgu_positions.position_id')
                ->join('offices', 'lgu_positions.office_id', 'offices.id')
                ->join('departments', 'departments.id', 'offices.department_id')
                ->join('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
                ->join('qualification_standards', 'positions.id', 'qualification_standards.position_id')
                ->where([["vacancies.id", "like", "%" . $searchKeyword . "%"], ["vacancies.date_submitted", "like", $year . "%"]])
                ->orWhere([["positions.title", "like", "%" . $searchKeyword . "%"], ["vacancies.date_submitted", "like", $year . "%"]])
                ->orWhere([["lgu_positions.item_number", "like", "%" . $searchKeyword . "%"], ["vacancies.date_submitted", "like", $year . "%"]])
                ->orWhere([["qualification_standards.education", "like", "%" . $searchKeyword . "%"], ["vacancies.date_submitted", "like", $year . "%"]])
                ->orWhere([["qualification_standards.eligibility", "like", "%" . $searchKeyword . "%"], ["vacancies.date_submitted", "like", $year . "%"]])
                ->orWhere([["qualification_standards.training", "like", "%" . $searchKeyword . "%"], ["vacancies.date_submitted", "like", $year . "%"]])
                ->orWhere([["qualification_standards.experience", "like", "%" . $searchKeyword . "%"], ["vacancies.date_submitted", "like", $year . "%"]])
                ->skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->take(10)
                ->get()
        );
        $pages = Vacancy::select("*", 'vacancies.id')
            ->join('lgu_positions', 'lgu_positions.id', 'vacancies.lgu_position_id')
            ->join('positions', 'positions.id', 'lgu_positions.position_id')
            ->join('offices', 'lgu_positions.office_id', 'offices.id')
            ->join('departments', 'departments.id', 'offices.department_id')
            ->join('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
            ->join('qualification_standards', 'positions.id', 'qualification_standards.position_id')
            ->where([["vacancies.id", "like", "%" . $searchKeyword . "%"], ["vacancies.date_submitted", "like", $year . "%"]])
            ->orWhere([["positions.title", "like", "%" . $searchKeyword . "%"], ["vacancies.date_submitted", "like", $year . "%"]])
            ->orWhere([["lgu_positions.item_number", "like", "%" . $searchKeyword . "%"], ["vacancies.date_submitted", "like", $year . "%"]])
            ->orWhere([["qualification_standards.education", "like", "%" . $searchKeyword . "%"], ["vacancies.date_submitted", "like", $year . "%"]])
            ->orWhere([["qualification_standards.eligibility", "like", "%" . $searchKeyword . "%"], ["vacancies.date_submitted", "like", $year . "%"]])
            ->orWhere([["qualification_standards.training", "like", "%" . $searchKeyword . "%"], ["vacancies.date_submitted", "like", $year . "%"]])
            ->orWhere([["qualification_standards.experience", "like", "%" . $searchKeyword . "%"], ["vacancies.date_submitted", "like", $year . "%"]])
            ->count();

        return compact('pages', 'data');
    }

    public function allApproved()
    {
        return VacancyResource::collection(
            Vacancy::with([
                'belongsToLguPosition.belongsToPosition',
                'belongsToLguPosition.belongsToPosition.belongsToSalaryGrade',
                'belongsToLguPosition.belongsToPosition.hasManyQualificationStandard',
                'hasManyPublication',
            ])
                ->where('status', 'Approved')
                ->get()
        );
    }

    public function allQueued()
    {
        return VacancyResource::collection(
            Vacancy::with([
                'belongsToLguPosition.belongsToPosition',
                'belongsToLguPosition.belongsToPosition.belongsToSalaryGrade',
                'belongsToLguPosition.belongsToPosition.hasManyQualificationStandard',
                'hasManyPublication',
            ])
                ->where('status', 'Queued')
                ->get()
        );
    }
}
