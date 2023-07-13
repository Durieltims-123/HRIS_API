<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Resources\VacancyResource;
use App\Http\Requests\StoreVacancyRequest;
use App\Models\Publication;

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
            ['lgu_position_id', $request->lgu_position_id],
            ['date_submitted', Date('Y-m-d', strtotime($request->date_submitted))]
        ])->exists();


        if ($vacancyExist) {
            return $this->error('', 'Duplicate Entry', 400);
        }

        Vacancy::create([
            'lgu_position_id' => $request->lgu_position_id,
            'date_submitted' => Date('Y-m-d', strtotime($request->date_submitted)),
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
        if (!is_null($request->date_queued)) {
            $vacancy->date_queued = Date('Y-m-d', strtotime($request->date_queued));
        }
        if (!is_null($request->date_queued)) {
            $vacancy->date_approved = Date('Y-m-d', strtotime($request->date_approved));
        }
        $vacancy->status = $request->status;
        $vacancy->save();
        return new VacancyResource($vacancy);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacancy $vacancy)
    {
        $publicationExists = Publication::where('vacancy_id', $vacancy->id)->exists();
        if ($publicationExists) {
            return $this->error('', 'You cannot delete Vacancy with Publication.', 400);
        } else {
            $vacancy->delete();
            return $this->success('', 'Successfully Deleted', 200);
        }
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
        $searchKeyword = $request->searchKeyword;
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $year = $request->year;

        $orderAscending  ? $orderAscending = 'asc' : $orderAscending = 'desc';
        $searchKeyword == null ? $searchKeyword = '' : $searchKeyword = $searchKeyword;
        ($orderBy == null || $orderBy == 'id') ? $orderBy = 'lgu_positions.id' : $orderBy = $orderBy;

        $data = VacancyResource::collection(
            Vacancy::select('*', 'vacancies.id', 'vacancies.status')
                ->join('lgu_positions', 'lgu_positions.id', 'vacancies.lgu_position_id')
                ->join('positions', 'positions.id', 'lgu_positions.position_id')
                ->join('offices', 'lgu_positions.office_id', 'offices.id')
                ->join('departments', 'departments.id', 'offices.department_id')
                ->join('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
                ->join('qualification_standards', 'positions.id', 'qualification_standards.position_id')
                ->leftJoin('position_descriptions', 'lgu_positions.id', 'position_descriptions.lgu_position_id')
                ->whereRaw('vacancies.date_submitted LIKE "%' . $searchKeyword . '%" AND vacancies.date_submitted LIKE "' . $year . '%" ')
                ->whereRaw('lgu_positions.id LIKE "%' . $searchKeyword . '%" AND vacancies.date_submitted LIKE "' . $year . '%" ')
                ->orWhereRaw('positions.title LIKE "%' . $searchKeyword . '%" AND vacancies.date_submitted LIKE "' . $year . '%" ')
                ->orWhereRaw('lgu_positions.item_number LIKE "%' . $searchKeyword . '%" AND vacancies.date_submitted LIKE "' . $year . '%" ')
                ->orWhereRaw('qualification_standards.education LIKE "%' . $searchKeyword . '%" AND vacancies.date_submitted LIKE "' . $year . '%" ')
                ->orWhereRaw('qualification_standards.eligibility LIKE "%' . $searchKeyword . '%" AND vacancies.date_submitted LIKE "' . $year . '%" ')
                ->orWhereRaw('qualification_standards.training LIKE "%' . $searchKeyword . '%" AND vacancies.date_submitted LIKE "' . $year . '%" ')
                ->orWhereRaw('qualification_standards.experience LIKE "%' . $searchKeyword . '%" AND vacancies.date_submitted LIKE "' . $year . '%" ')
                ->orWhereRaw('position_descriptions.description LIKE "%' . $searchKeyword . '%" AND vacancies.date_submitted LIKE "' . $year . '%" ')
                ->skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->take(10)
                ->get()
        );
        $pages =
            Vacancy::select('*', 'vacancies.id', 'vacancies.status')
            ->join('lgu_positions', 'lgu_positions.id', 'vacancies.lgu_position_id')
            ->leftJoin('positions', 'positions.id', 'lgu_positions.position_id')
            ->join('offices', 'lgu_positions.office_id', 'offices.id')
            ->join('departments', 'departments.id', 'offices.department_id')
            ->join('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
            ->join('qualification_standards', 'positions.id', 'qualification_standards.position_id')
            ->leftJoin('position_descriptions', 'lgu_positions.id', 'position_descriptions.lgu_position_id')
            ->whereRaw('lgu_positions.id LIKE "%' . $searchKeyword . '%" AND vacancies.date_submitted LIKE "' . $year . '%" ')
            ->orWhereRaw('positions.title LIKE "%' . $searchKeyword . '%" AND vacancies.date_submitted LIKE "' . $year . '%" ')
            ->orWhereRaw('lgu_positions.item_number LIKE "%' . $searchKeyword . '%" AND vacancies.date_submitted LIKE "' . $year . '%" ')
            ->orWhereRaw('qualification_standards.education LIKE "%' . $searchKeyword . '%" AND vacancies.date_submitted LIKE "' . $year . '%" ')
            ->orWhereRaw('qualification_standards.eligibility LIKE "%' . $searchKeyword . '%" AND vacancies.date_submitted LIKE "' . $year . '%" ')
            ->orWhereRaw('qualification_standards.training LIKE "%' . $searchKeyword . '%" AND vacancies.date_submitted LIKE "' . $year . '%" ')
            ->orWhereRaw('qualification_standards.experience LIKE "%' . $searchKeyword . '%" AND vacancies.date_submitted LIKE "' . $year . '%" ')
            ->orWhereRaw('position_descriptions.description LIKE "%' . $searchKeyword . '%" AND vacancies.date_submitted LIKE "' . $year . '%" ')
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
