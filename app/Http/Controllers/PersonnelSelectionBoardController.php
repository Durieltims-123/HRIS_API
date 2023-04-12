<?php

namespace App\Http\Controllers;

use App\Models\PsbMember;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\PersonnelSelectionBoard;
use App\Http\Requests\StorePsbMemberRequest;
use App\Http\Resources\PersonnelSelectionBoardResource;
use App\Http\Requests\StorePersonnelSelectionBoardRequest;
use App\Http\Resources\PsbMemberResource;

class PersonnelSelectionBoardController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PersonnelSelectionBoardResource::collection(
            PersonnelSelectionBoard::with('hasManyMembers')->get()
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
    public function store(StorePersonnelSelectionBoardRequest $psbRequest)
    {

        // validate input fields
        $psbRequest->validated($psbRequest->all());

        // validate user from database
        $PsbExists = PersonnelSelectionBoard::where([
            ['start_date', $psbRequest->start_date],
            ['end_date', $psbRequest->end_date],
            ['chairman', $psbRequest->chairman],
            ['position', $psbRequest->position],
            ['status', $psbRequest->status],
        ])->exists();
        if ($PsbExists) {
            return $this->error('', 'Duplicate Entry', 400);
        }

        
        $personnelSelection = PersonnelSelectionBoard::create([
            "start_date" => $psbRequest->start_date,
            "end_date" => $psbRequest->end_date,
            "chairman" => $psbRequest->chairman,
            "position" => $psbRequest->position,
            "status" => $psbRequest->status
        ]);

        
        $ids = $psbRequest->input('employee_id');
        $names = $psbRequest->input('member_name');
        $positions = $psbRequest->input('member_position');
       
        //to convert to array
        // $names = (explode(",", $name));
        // $positions = (explode(",", $position));
        // $ids = (explode(",", $id));
        

        foreach ($names as $i => $name) {
            PsbMember::create([
                "personnel_selection_board_id" => $personnelSelection->id,
                "employee_id" => $ids[$i],
                "member_name" => $name,
                "member_position" => $positions[$i]
            ]);
        }

        // return message
        return $this->success('', 'Successfull Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PersonnelSelectionBoard $personnelSelectionBoard)
    {
        
        return PersonnelSelectionBoardResource::collection(
            PersonnelSelectionBoard::with('hasManyMembers')
            ->where('id',$personnelSelectionBoard->id)
            ->get()
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
    public function update(StorePersonnelSelectionBoardRequest $psbRequest, 
    PersonnelSelectionBoard $personnelSelectionBoard)
    {
        $psbRequest->validated($psbRequest->all());
        // Update PSB
        $personnelSelectionBoard->start_date = $psbRequest->start_date;
        $personnelSelectionBoard->end_date = $psbRequest->end_date;
        $personnelSelectionBoard->chairman = $psbRequest->chairman;
        $personnelSelectionBoard->position = $psbRequest->position;
        $personnelSelectionBoard->status = $psbRequest->status;

        
        $ids = $psbRequest->input('employee_id');
        $names = $psbRequest->input('member_name');
        $positions = $psbRequest->input('member_position');

        foreach ($names as $i => $name) 
        {
            $memberExists = PsbMember::where([['member_name', $name], 
            ['personnel_selection_board_id', $personnelSelectionBoard->id]])->exists();
            //    check if member exist
            if ($memberExists === true) {
                PsbMember::where([['member_name', $name], ['personnel_selection_board_id', 
                $personnelSelectionBoard->id]])
                    ->update([
                        "personnel_selection_board_id" => $personnelSelectionBoard->id,
                        "employee_id" => $ids[$i],
                        "member_position" => $positions[$i]
                    ]);
            } else {
                PsbMember::create([
                    "personnel_selection_board_id" => $personnelSelectionBoard->id,
                    "employee_id" => $ids[$i],
                    "member_name" => $name,
                    "member_position" => $positions[$i]
                ]);
            }
        }
        
        // Delete members
        $delete = PsbMember::where('personnel_selection_board_id', $personnelSelectionBoard->id)
            ->whereNotIn('member_name', $names)
            ->delete();

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
