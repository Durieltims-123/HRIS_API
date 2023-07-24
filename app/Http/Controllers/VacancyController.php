<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Resources\VacancyResource;
use App\Http\Requests\StoreVacancyRequest;
use App\Models\Publication;
use Illuminate\Contracts\Validation\Validator;

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
            ['lgu_position_id', $request->position_id],
            ['date_submitted', Date('Y-m-d', strtotime($request->date_submitted))]
        ])->exists();


        if ($vacancyExist) {
            return $this->error('', 'Duplicate Entry', 400);
        }

        Vacancy::create([
            'lgu_position_id' => $request->position_id,
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
        return Vacancy::select('*', 'vacancies.id', 'vacancies.status')
            ->join('lgu_positions', 'lgu_positions.id', 'vacancies.lgu_position_id')
            ->leftJoin('positions', 'positions.id', 'lgu_positions.position_id')
            ->join('offices', 'lgu_positions.office_id', 'offices.id')
            ->join('departments', 'departments.id', 'offices.department_id')
            ->join('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
            ->join('qualification_standards', 'positions.id', 'qualification_standards.position_id')
            ->leftJoin('position_descriptions', 'lgu_positions.id', 'position_descriptions.lgu_position_id')
            ->where("vacancies.id", $vacancy->id)->first();
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
    public function update(StoreVacancyRequest $request, Vacancy $vacancy)
    {
        $request->validated($request->all());
        $vacancy->date_submitted = Date('Y-m-d', strtotime($request->date_submitted));
        if (!is_null($request->date_queued)) {
            $vacancy->date_queued = Date('Y-m-d', strtotime($request->date_queued));
        }
        if (!is_null($request->date_approved)) {
            $vacancy->date_approved = Date('Y-m-d', strtotime($request->date_approved));
        }
        $vacancy->lgu_position_id = $request->position_id;
        $vacancy->status = $request->status;
        $vacancy->save();

        if (!is_null($request->date_approved)) {
            $publication_exists = Publication::where('vacancy_id', $request->id)->exists();
            if ($publication_exists) {
                $publication = Publication::where('vacancy_id', $request->id)->orderBy('id', 'desc')->first();
                Publication::where('id', $publication->id)->update([
                    "posting_date" =>  Date('Y-m-d', strtotime($request->posting_date)),
                    "closing_date" =>  Date('Y-m-d', strtotime($request->closing_date))
                ]);
            } else {
                Publication::create([
                    "vacancy_id" => $vacancy->id,
                    "posting_date" =>  Date('Y-m-d', strtotime($request->posting_date)),
                    "closing_date" =>  Date('Y-m-d', strtotime($request->closing_date))
                ]);
            }
        }


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


    public function search(Request $request)
    {
        $activePage = $request->activePage;
        $status = $request->status;
        // initial test
        $searchKeyword = $request->searchKeyword;
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $year = $request->year;

        $filter = $request->filter;

        $orderAscending  ? $orderAscending = 'asc' : $orderAscending = 'desc';
        $searchKeyword == null ? $searchKeyword = '' : $searchKeyword = $searchKeyword;
        ($orderBy == null || $orderBy == 'id') ? $orderBy = 'vacancies.id' : $orderBy = $orderBy;

        $data = VacancyResource::collection(
            Vacancy::select(
                'vacancies.id',
                'date_submitted',
                'date_queued',
                'date_approved',
                'posting_date',
                'closing_date',
                'office_name',
                'department_name',
                'office_id',
                'positions.id as position_id',
                'year',
                'title',
                'number',
                'amount',
                'item_number',
                'education',
                'training',
                'experience',
                'eligibility',
                'competency',
                'vacancies.status',
                'description',
                'place_of_assignment',
                'position_status',
            )
                ->leftJoin('publications', 'publications.vacancy_id', 'vacancies.id')
                ->join('lgu_positions', 'lgu_positions.id', 'vacancies.lgu_position_id')
                ->join('positions', 'positions.id', 'lgu_positions.position_id')
                ->join('offices', 'lgu_positions.office_id', 'offices.id')
                ->join('departments', 'departments.id', 'offices.department_id')
                ->join('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
                ->join('qualification_standards', 'positions.id', 'qualification_standards.position_id')
                ->leftJoin('position_descriptions', 'lgu_positions.id', 'position_descriptions.lgu_position_id')
                ->where([['vacancies.date_submitted', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
                ->where([['lgu_positions.id', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
                ->orwhere([['positions.title', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
                ->orwhere([['lgu_positions.item_number', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
                ->orwhere([['qualification_standards.education', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
                ->orwhere([['qualification_standards.eligibility', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
                ->orwhere([['qualification_standards.training', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
                ->orwhere([['qualification_standards.experience', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
                ->orwhere([['position_descriptions.description', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
                ->skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->take(10)
                ->get()
        );
        $pages =
            Vacancy::select('*')
            ->leftJoin('publications', 'publications.vacancy_id', 'vacancies.id')
            ->join('lgu_positions', 'lgu_positions.id', 'vacancies.lgu_position_id')
            ->leftJoin('positions', 'positions.id', 'lgu_positions.position_id')
            ->join('offices', 'lgu_positions.office_id', 'offices.id')
            ->join('departments', 'departments.id', 'offices.department_id')
            ->join('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
            ->join('qualification_standards', 'positions.id', 'qualification_standards.position_id')
            ->leftJoin('position_descriptions', 'lgu_positions.id', 'position_descriptions.lgu_position_id')
            ->where([['lgu_positions.id', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
            ->orwhere([['positions.title', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
            ->orwhere([['lgu_positions.item_number', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
            ->orwhere([['qualification_standards.education', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
            ->orwhere([['qualification_standards.eligibility', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
            ->orWhere([['qualification_standards.training', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
            ->orWhere([['qualification_standards.experience', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
            ->orWhere([['position_descriptions.description', 'like', '%' . $searchKeyword . '%'], ['vacancies.date_submitted', 'like', '%' . $year . '%'], $filter])
            ->count();

        return compact('pages', 'data', 'filter');
    }
}
