<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonnelSelectionBoardRequest;
use App\Http\Resources\PersonnelSelectionBoardResource;
use App\Models\PersonnelSelectionBoard;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;


class PersonnelSelectionBoardController extends Controller
{
    use HttpResponses;
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
    public function store(StorePersonnelSelectionBoardRequest $request)
    {
        // validate input fields
        $request->validated($request->all());

        

        // validate user from database
        $PsbExists = PersonnelSelectionBoard::where([
            ['start_date', $request->start_date], 
            ['end_date', $request->end_date],
            ['chairman', $request->chairman],
            ['position', $request->position],
            ['status', $request->status],
            ])->exists();
        if ($PsbExists) {
            return $this->error('', 'Duplicate Entry', 400);
        }

        PersonnelSelectionBoard::create([
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "chairman" => $request->chairman,
            "position" => $request->position,
            "status" => $request->status
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
    public function update(Request $request, PersonnelSelectionBoard $personnelSelectionBoard)
    {
        
            $personnelSelectionBoard->start_date = $request->start_date;
            $personnelSelectionBoard->end_date = $request->end_date;
            $personnelSelectionBoard->chairman = $request->chairman;
            $personnelSelectionBoard->position = $request->position;
            $personnelSelectionBoard->status = $request->status;
            $personnelSelectionBoard->save();

            return new PersonnelSelectionBoardResource($personnelSelectionBoard);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonnelSelectionBoard $personnelSelectionBoard)
    {
        $personnelSelectionBoard->delete();
        return $this->success('', 'Successfull Deleted', 200);
    }
}
