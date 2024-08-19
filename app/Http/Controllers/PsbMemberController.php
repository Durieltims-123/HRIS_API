<?php

namespace App\Http\Controllers;

use App\Models\PsbMember;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Requests\StorePsbMemberRequest;
use App\Models\PsbPersonnel;

class PsbMemberController extends Controller
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
    public function store(StorePsbMemberRequest $request)
    {
        $request->validated($request->all());
        // dd("hey");
        $PsbMemberExists = PsbPersonnel::where([
            ['member_name', $request->member_name], 
            ['member_position', $request->member_position],
            ])->exists();
            if ($PsbMemberExists) {
                return $this->error('', 'Duplicate Entry', 400);
            }

        PsbPersonnel::create([
            "perselbo_id" => $request->perselbo_id,
            "member_name" => $request->member_name,
            "member_position" => $request->member_position
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
