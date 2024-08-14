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
use App\Models\PersonalDataSheet;

class PersonnelSelectionBoardController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PersonnelSelectionBoardResource::collection(
            PersonnelSelectionBoard::with('psbMembers')->get()
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
            ['date_of_effectivity', $psbRequest->date_of_effectivity],
            ['end_of_effectivity', $psbRequest->end_of_effectivity],
            ['presiding_officer', $psbRequest->presiding_officer],
            ['presiding_officer_position', $psbRequest->presiding_officer_position],
        ])->exists();

        if ($PsbExists) {
            return $this->error('', 'Duplicate Entry', 400);
        }


        $psb = PersonnelSelectionBoard::create([
            "date_of_effectivity" => $psbRequest->date_of_effectivity,
            "end_of_effectivity" => $psbRequest->end_of_effectivity,
            "presiding_officer" => $psbRequest->presiding_officer,
            "presiding_officer_position" => $psbRequest->presiding_officer_position
        ]);


        $psb->psbMembers()->createMany($psbRequest->members);

        // return message
        return $this->success('', 'Successfully Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PersonnelSelectionBoard $personnelSelectionBoard)
    {
        $members = $personnelSelectionBoard->psbMembers->select("name", "position");

        return compact('personnelSelectionBoard', 'members');
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
    public function update(
        StorePersonnelSelectionBoardRequest $psbRequest,
        PersonnelSelectionBoard $personnelSelectionBoard
    ) {
        $psbRequest->validated($psbRequest->all());


        // validate user from database
        $PsbExists = PersonnelSelectionBoard::where([
            ['id', '<>', $personnelSelectionBoard->id],
            ['date_of_effectivity', $psbRequest->date_of_effectivity],
            ['end_of_effectivity', $psbRequest->end_of_effectivity],
            ['presiding_officer', $psbRequest->presiding_officer],
            ['presiding_officer_position', $psbRequest->presiding_officer_position],
        ])->exists();

        if ($PsbExists) {
            return $this->error('', 'Duplicate Entry', 400);
        }

        $personnelSelectionBoard->date_of_effectivity = $psbRequest->date_of_effectivity;
        $personnelSelectionBoard->end_of_effectivity = $psbRequest->end_of_effectivity;
        $personnelSelectionBoard->presiding_officer = $psbRequest->presiding_officer;
        $personnelSelectionBoard->presiding_officer_position = $psbRequest->presiding_officer_position;


        $personnelSelectionBoard->psbMembers()->forceDelete();

        $personnelSelectionBoard->psbMembers()->createMany($psbRequest->members);

        $personnelSelectionBoard->save();

        return new PersonnelSelectionBoardResource($personnelSelectionBoard);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonnelSelectionBoard $personnelSelectionBoard)
    {
        $personnelSelectionBoard->delete();
        return $this->success('', 'Successfully Deleted', 200);
    }



    public function search(Request $request)
    {
        $activePage = $request->activePage;
        $filters = $request->filters;
        $fill = $request->filters;
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $orderAscending  ? $orderAscending = "asc" : $orderAscending = "desc";
        if (!is_null($filters)) {
            $filters =  array_map(function ($filter) {
                if ($filter['column'] === "id") {
                    return ['personnel_selection_boards.id', 'like', '%' . $filter['value'] . '%'];
                } else {
                    return [$filter['column'], 'like', '%' . $filter['value'] . '%'];
                }
            }, $filters);
        } else {
            $filters = [['personnel_selection_boards.id', 'like', '%']];
        }


        $orderBy == null ? $orderBy = "id" : $orderBy = $orderBy;

        $data = PersonnelSelectionBoardResource::collection(
            PersonnelSelectionBoard::skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->with('psbMembers')
                ->where($filters)
                ->take(10)
                ->get()
        );

        $pages = PersonnelSelectionBoard::where($filters)
            ->orderBy($orderBy, $orderAscending)
            ->count();

        return compact('pages', 'data', 'fill');
    }
}
