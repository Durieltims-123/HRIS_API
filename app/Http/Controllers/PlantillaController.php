<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlantillaRequest;
use App\Http\Resources\PlantillaResource;
use App\Models\Plantilla;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class PlantillaController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PlantillaResource::collection(
            Plantilla::all()
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
    public function store(StorePlantillaRequest $request)
    {
        $request->validated($request->all());

        $plantillaExist = Plantilla::where(['place_of_assignment', $request->place_of_assignment])->exists();
        if ($plantillaExist) {
            return $this->error('', 'Duplicate Entry', 400);
        }

        Plantilla::create([
            "place_of_assignment" => $request->place_of_assignment
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
    public function update(Request $request, Plantilla $plantilla)
    {
        $plantilla->place_of_assignment = $request->place_of_assignment;
        $plantilla->save();

        return new PlantillaResource($plantilla);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plantilla $plantilla)
    {
        $plantilla->delete();
        return $this->success('', 'Successfull Deleted', 200);
    }
}
