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


    public function search(Request $request)
    {
        $activePage = $request->activePage;
        $status = $request->status;
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $year = $request->year;
        $filter = $request->filter;
        $orderAscending  ? $orderAscending = "asc" : $orderAscending = "desc";

        ($orderBy == null || $orderBy == "id") ? $orderBy = "interviews.id" : $orderBy = $orderBy;
        $filters = $request->filters;
        if (!is_null($filters)) {
            $filters =  array_map(function ($filter) {
                if ($filter["column"] === "id") {
                    return ["interviews.id", "like", "%" . $filter["value"] . "%"];
                } else {
                    return [$filter["column"], "like", "%" . $filter["value"] . "%"];
                }
            }, $filters);
        } else {
            $filters = [["interviews.id", "like", "%"]];
        }

        $data = InterviewResource::collection(
            Interview::select("interviews.*", "venues.name")
                ->where($filters)
                ->join('venues', 'venues.id', 'interviews.venue')
                ->skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->take(10)
                ->get()
        );

        $pages =
            Interview::select(
                "applicants.id"
            )
            ->join('venues', 'venues.id', 'interviews.venue')
            ->where($filters)
            ->count();

        return compact("pages", "data");
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
            'meeting_date' => $request->meeting_date,
            'venue' => $request->venue,
        ]);

        $vacancies_data = array_map(function ($item) {
            return ["vacancy_id" => $item];
        }, $request->positions);


        $interview->vacancyInterview()->createMany($vacancies_data);

        return $this->success('', 'Successfully Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Interview $interview)
    {
        $positions = $interview->vacancyInterview;
        return compact(
            'interview',
            'positions'
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
    public function update(Request $request, Interview $interview)
    {
        $interview->meeting_date = $request->meeting_date;
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

        return $this->success('', 'Successfully Deleted', 200);
    }
}
