<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Vacancy;
use App\Models\Position;
use App\Models\Plantilla;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Resources\VacancyResource;
use App\Http\Requests\StoreVacancyRequest;
use App\Models\PositionDescription;

class VacancyController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return VacancyResource::collection(
            Vacancy::all()
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
        // dd($request->date_approved);

        $request->validated($request->all());

        $positionId =  Position::where('title', $request->position_title)->pluck('id')->first();
       
        $office = Office::create([
            'office_code' => $request->office_code,
            'office_name' => $request->office_name
        ]);

        $plantilla = Plantilla::create([
            'office_id' => $office->id,
            'position_id' => $positionId,
            'place_of_assignment' => $request->place_of_assignment,
        ]); 

        PositionDescription::create([
            'description' => $request->job_description,
        ]);


        // $vacancyExist = Vacancy::where([
        //     ['date_submitted', Date('Y-m-d', strtotime($request->date_submitted))],
        //     ['date_queued', Date('Y-m-d', strtotime($request->date_queued))],
        //     ['date_approved', Date('Y-m-d', strtotime($request->date_approved))],
        //     ['status', $request->status]
        //     ])->exists();
        // if ($vacancyExist) {
        //     return $this->error('', 'Duplicate Entry', 400);
        // }
            
        Vacancy::create([
            'plantilla_id' => $plantilla->id,
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
    public function update(StoreVacancyRequest $request, Vacancy $vacancy, Office $office, Plantilla $plantilla)
    {

        $positionId =  Position::where('title', $request->position_title)->pluck('id')->first();
        
        $office = Office::where('id', $positionId)->first();
        $office->office_code = $request->office_code;
        $office->office_name = $request->office_name;

        $plantilla->office_id = $office->id;
        $plantilla->position_id = $positionId;
        $plantilla->place_of_assignment = $request->place_of_assignment;

        $vacancy->date_submitted = Date('Y-m-d', strtotime($request->date_submitted));
        $vacancy->date_queued = Date('Y-m-d', strtotime($request->date_queued));
        $vacancy->date_approved = Date('Y-m-d', strtotime($request->date_approved));
        $vacancy->status = $request->status;

        $plantilla->save();
        $office->save();
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
}
