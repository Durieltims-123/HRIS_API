<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePositionRequest;
use App\Http\Resources\PositionResource;
use App\Models\Position;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PositionResource::collection(
            Position::all()
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
    public function store(StorePositionRequest $request)
    {
            // validate input fields
            $request->validated($request->all());
//  dd($request);
            // validate user from database
            $positionExist = Position::where('title', $request->title);
            dd($positionExist);
            if ($positionExist) {
                return $this->error('', 'Duplicate Entry', 400);
            }
    
            Position::create([
                "title" => $request->title
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
    public function update(Request $request, Position $position)
    {
    
            
                $position->title = $request->title;
                $position->save();
        
                // $holiday->update($request->all());
                return new PositionResource($position);

     }

 /**
     * Remove the specified resource from storage.
     */

    public function destroy(Position $position)
    {
 
       $position->delete();
        return $this->success('', 'Successfull Deleted', 200);
    
    }
}
