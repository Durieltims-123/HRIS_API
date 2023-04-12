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
                'belongsToPlantilla.belongsToPosition',
                'belongsToPlantilla.belongsToPosition.belongsToSalaryGrade',
                'belongsToPlantilla.belongsToPosition.hasManyQualificationStandard',
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
            'plantilla_id' => $request->plantilla_id,
            'date_submitted' => Date('Y-m-d', strtotime($request->date_submitted)),
            'date_queued' => Date('Y-m-d', strtotime($request->date_queued)),
            'date_approved' => Date('Y-m-d', strtotime($request->date_approved)),
            'status' => $request->status
        ]);

        // return message
        return $this->success('', 'Successfull Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacancy $vacancy)
    {
        return (new VacancyResource($vacancy->loadMissing(['belongsToPlantilla.belongsToPosition'])));
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
        return $this->success('', 'Successfull Deleted', 200);
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

    public function allApproved()
    {
        return VacancyResource::collection(
            Vacancy::with([
                'belongsToPlantilla.belongsToPosition',
                'belongsToPlantilla.belongsToPosition.belongsToSalaryGrade',
                'belongsToPlantilla.belongsToPosition.hasManyQualificationStandard',
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
                'belongsToPlantilla.belongsToPosition',
                'belongsToPlantilla.belongsToPosition.belongsToSalaryGrade',
                'belongsToPlantilla.belongsToPosition.hasManyQualificationStandard',
                'hasManyPublication',
            ])
            ->where('status', 'Queued')
            ->get()
        );
    }
}
