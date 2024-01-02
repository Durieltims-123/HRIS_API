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
        return Vacancy::select(
            'lgu_positions.id as lgu_position_id',
            'vacancies.id',
            'date_submitted',
            'date_queued',
            'date_approved',
            'posting_date',
            'closing_date',
            'division_name',
            'office_name',
            'division_id',
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
            'publication_status'
        )
            ->leftJoin('publications', 'publications.vacancy_id', 'vacancies.id')
            ->join('lgu_positions', 'lgu_positions.id', 'vacancies.lgu_position_id')
            ->leftJoin('positions', 'positions.id', 'lgu_positions.position_id')
            ->join('divisions', 'lgu_positions.division_id', 'divisions.id')
            ->join('offices', 'offices.id', 'divisions.office_id')
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

        // return $vacancy->id;

        $vacancy->date_submitted = Date('Y-m-d', strtotime($request->date_submitted));
        if (!is_null($request->date_queued)) {
            $vacancy->date_queued = Date('Y-m-d', strtotime($request->date_queued));
        }
        if (!is_null($request->date_approved)) {
            $vacancy->date_approved = Date('Y-m-d', strtotime($request->date_approved));
        }
        $vacancy->lgu_position_id = $request->position_id;

        if ($request->process == "Reactivate") {
            $publication_exists = Publication::where('vacancy_id', $vacancy->id)->orderBy('id', 'desc')->exists();
            if ($publication_exists) {
                $publication = Publication::where('vacancy_id', $vacancy->id)->orderBy('id', 'desc')->first();
                if ($publication->publication_status === "Closed") {
                    return $this->error('', 'Sorry! You cannot Reactivate Vacancy when publication is already closed', 400);
                } else {
                    Publication::where('vacancy_id', $vacancy->id)->orderBy('id', 'desc')->delete();
                }
            }
            $vacancy->date_queued = null;
            $vacancy->status = 'Active';
        } else {
            $vacancy->status = $request->status;
        }
        $vacancy->save();

        if (!is_null($request->date_approved)) {
            $publication_exists = Publication::where('vacancy_id', $vacancy->id)->exists();
            if ($publication_exists) {
                $publication = Publication::where('vacancy_id', $vacancy->id)->orderBy('id', 'desc')->first();
                Publication::where('id', $publication->id)->update([
                    "posting_date" =>  Date('Y-m-d', strtotime($request->posting_date)),
                    "closing_date" =>  Date('Y-m-d', strtotime($request->closing_date)),
                    "publication_status" => $request->publication_status
                ]);
            } else {
                Publication::create([
                    "vacancy_id" => $vacancy->id,
                    "posting_date" =>  Date('Y-m-d', strtotime($request->posting_date)),
                    "closing_date" =>  Date('Y-m-d', strtotime($request->closing_date)),
                    "publication_status" => "Active"
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
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $year = $request->year;
        $filters = $request->filters;
        if (!is_null($filters)) {
            $filters =  array_map(function ($filter) {
                if ($filter['column'] === "id") {
                    return ['vacancies.id', 'like', '%' . $filter['value'] . '%'];
                } else {
                    return [$filter['column'], 'like', '%' . $filter['value'] . '%'];
                }
            }, $filters);
        } else {
            $filters = [['vacancies.id', 'like', '%']];
        }

        $orderAscending  ? $orderAscending = 'asc' : $orderAscending = 'desc';
        ($orderBy == null || $orderBy == 'id') ? $orderBy = 'vacancies.id' : $orderBy = $orderBy;

        $data = VacancyResource::collection(
            Vacancy::select(
                'lgu_positions.id as lgu_position_id',
                'vacancies.id',
                'date_submitted',
                'date_queued',
                'date_approved',
                'posting_date',
                'closing_date',
                'division_name',
                'office_name',
                'division_id',
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
                'publication_status'
            )
                ->leftJoin('publications', 'publications.vacancy_id', 'vacancies.id')
                ->join('lgu_positions', 'lgu_positions.id', 'vacancies.lgu_position_id')
                ->join('positions', 'positions.id', 'lgu_positions.position_id')
                ->join('divisions', 'lgu_positions.division_id', 'divisions.id')
                ->join('offices', 'offices.id', 'divisions.office_id')
                ->join('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
                ->join('qualification_standards', 'positions.id', 'qualification_standards.position_id')
                ->leftJoin('position_descriptions', 'lgu_positions.id', 'position_descriptions.lgu_position_id')
                ->where($filters)
                ->skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->take(10)
                ->get()
        );
        $pages =
            Vacancy::select('vacancy.id')
            ->leftJoin('publications', 'publications.vacancy_id', 'vacancies.id')
            ->join('lgu_positions', 'lgu_positions.id', 'vacancies.lgu_position_id')
            ->leftJoin('positions', 'positions.id', 'lgu_positions.position_id')
            ->join('divisions', 'lgu_positions.division_id', 'divisions.id')
            ->join('offices', 'offices.id', 'divisions.office_id')
            ->join('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
            ->join('qualification_standards', 'positions.id', 'qualification_standards.position_id')
            ->leftJoin('position_descriptions', 'lgu_positions.id', 'position_descriptions.lgu_position_id')
            ->where($filters)
            ->count();

        return compact('pages', 'data');
    }
}
