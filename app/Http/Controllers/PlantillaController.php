<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlantillaRequest;
use App\Http\Resources\PlantillaResource;
use App\Models\Plantilla;
use App\Models\PositionDescription;
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
        
        $plantilla = Plantilla::with(['hasOneVacancy'])->get();
      
        return PlantillaResource::collection($plantilla);
    //    return $plantilla->mapInto(VacancyResource::class);
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

        $plantillaExist = Plantilla::where('item_number', $request->item_number)->exists();
        if ($plantillaExist) {
            return $this->error('', 'Duplicate Entry', 400);
        }

        $plantilla = Plantilla::create([
            'office_id' => $request->office_id,
            'position_id' => $request->position_id,
            'item_number' => $request->item_number, 
            "place_of_assignment" => $request->place_of_assignment,
            "year" => $request->year
        ]);

        PositionDescription::create([
            'plantilla_id' => $plantilla->id,
            'description' => $request->description
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
        $plantilla->item_number = $request->item_number;
        $plantilla->place_of_assignment = $request->place_of_assignment;
        $plantilla->year = $request->year;
        $plantilla->save();

        PositionDescription::where('plantilla_id',$plantilla->id)
        ->update([
            'plantilla_id' => $plantilla->id,
            'description' => $request->description
        ]);

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
