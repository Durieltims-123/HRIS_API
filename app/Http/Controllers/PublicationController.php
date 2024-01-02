<?php

namespace App\Http\Controllers;

use App\Http\Resources\PublicationResource;
use App\Http\Resources\VacancyResource;
use App\Models\Publication;
use App\Models\Vacancy;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PublicationResource::collection(
            Publication::with('belongsToVacancy')->get()
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
    public function store(Request $request, Publication $publication)
    {

        Publication::create([
            "vacancy_id" => $request->vacancy_id,
            "posting_date" => $request->posting_date,
            "closing_date" => $request->closing_date
        ]);
        $today = Carbon::today()->toDateString();
        Vacancy::where('id', $request->vacancy_id)
        ->update([
            'status' => 'Approved',
            'date_approved' => $today,
        ]);

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
    public function update(Request $request, Publication $publication)
    {
        $publication->posting_date = $request->posting_date;
        $publication->closing_date = $request->closing_date;
        $publication->vacancy_id = $request->vacancy_id;

        $publication->save();

        return new PublicationResource($publication);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function searchClosingDate(Request $request){

        $date = Carbon::createFromFormat('Y-m-d', $request->posting_date); // Convert input date to Carbon instance

        $closingDate = $date->copy()->addDays(15); // Add 14 days to the input date to get the 15th date

       return $closingDate->toDateString();
    }

}
