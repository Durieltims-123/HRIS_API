<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePositionDescriptionRequest;
use App\Http\Resources\PositionDescriptionResource;
use App\Models\PositionDescription;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class PositionDescriptionController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PositionDescriptionResource::collection(
            PositionDescription::all()
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
    public function store(StorePositionDescriptionRequest $request)
    {
        $request->validated($request->all());

        $positionDescriptionExist = positionDescription::where(['description', $request->description])->exists();
        if ($positionDescriptionExist) {
            return $this->error('', 'Duplicate Entry', 400);
        }

        PositionDescription::create([
            "description" => $request->description,
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
    public function update(Request $request, PositionDescription $positionDescription)
    {
        $positionDescription->description = $request->description;
        $positionDescription->save();

        return new PositionDescriptionResource($positionDescription);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PositionDescription $positionDescription)
    {
        $positionDescription->delete();
        return $this->success('', 'Successfull Deleted', 200);
    }
}
