<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreOathTakingRequest;
use App\Models\Applicant;
use App\Models\OathTakers;
use App\Models\OathTaking;

class OathTakingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreOathTakingRequest $request)
    {
        $request->validate($request->all());

        $appointeds = $request->input('appointed_applicants');

        // loop through the ids of the selected applicants and store
        foreach ($appointeds as $i => $appointed) {
            $appointedExists = Applicant::where([
                ['member_name', $appointed],
                ['personnel_selection_board_id', $request->id]
            ])->exists();

            if ($appointedExists) {
                // pull information in the database to store for the oath taking
                

                OathTaking::create([
                    "venue" => $request->venue[$i],
                    "date" => $request->date[$i],
                ]);
            }
        }


        //get the id of the appointed applicants and store to array
        //based from id, query the table of appointed applicants
        OathTakers::create([]);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
