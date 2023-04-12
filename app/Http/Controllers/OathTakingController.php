<?php

namespace App\Http\Controllers;

use App\Models\OathTaker;
use App\Models\OathTaking;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Resources\OathTakingResource;
use App\Http\Requests\StoreOathTakingRequest;

class OathTakingController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OathTakingResource::collection(
            OathTaking::with('hasManyOathTakers')->get()
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
    public function store(StoreOathTakingRequest $request)
    {
        // dd($request->venue);
        $request->validated($request->all());

        $oathTaking = OathTaking::create([
            "venue" => $request->venue,
            "oath_date" => $request->oath_date,
            "date_generated" => $request->date_generated
        ]);

        $appointment_ids = $request->input('appointment_id');
        $first_names = $request->input('first_name');
        $last_names = $request->input('last_name');
        $departments = $request->input('department');
        $job_titles = $request->input('job_title');
        $date_appointeds = $request->input('date_appointed');

        foreach ($appointment_ids as $i => $appointment_id) {

            OathTaker::create([
                'oathtaking_id' => $oathTaking->id,
                'appointment_id' => $appointment_id,
                'first_name' => $first_names[$i],
                'last_name' => $last_names[$i],
                'department' => $departments[$i],
                'job_title' => $job_titles[$i],
                'date_appointed' => $date_appointeds[$i],
            ]);
        }

        return $this->success('', 'Successfully Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(OathTaking $oathtaking)
    {
        return (new OathTakingResource($oathtaking->loadMissing('hasManyOathTakers')));
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
    public function update(Request $request, OathTaking $oathtaking)
    {
       
        $oathtaking->venue = $request->venue;
        $oathtaking->oath_date = $request->oath_date;
        $oathtaking->date_generated = $request->date_generated;

        $appointment_ids = $request->input('appointment_id');
        $first_names = $request->input('first_name');
        $last_names = $request->input('last_name');
        $departments = $request->input('department');
        $job_titles = $request->input('job_title');
        $date_appointeds = $request->input('date_appointed');

        foreach ($appointment_ids as $i => $appointment_id) {
            $oathTakerExists = OathTaker::where([['oathtaking_id',$oathtaking->id],['appointment_id', $appointment_id], ['first_name', $first_names[$i]], ['last_name', $last_names[$i]]])->exists();
            if ($oathTakerExists) {
                OathTaker::where([['oathtaking_id',$oathtaking->id],['appointment_id', $appointment_id], ['first_name', $first_names[$i]], ['last_name', $last_names[$i]]])
                    ->update([
                        'appointment_id' => $appointment_id,
                        'first_name' => $first_names[$i],
                        'last_name' => $last_names[$i],
                        'department' => $departments[$i],
                        'job_title' => $job_titles[$i],
                        'date_appointed' => $date_appointeds[$i],
                    ]);
            }else{
                OathTaker::create([
                    'oathtaking_id' => $oathtaking->id,
                    'appointment_id' => $appointment_id,
                    'first_name' => $first_names[$i],
                    'last_name' => $last_names[$i],
                    'department' => $departments[$i],
                    'job_title' => $job_titles[$i],
                    'date_appointed' => $date_appointeds[$i],
                ]);
            }
        }
        $delete = OathTaker::where('oathtaking_id', $oathtaking->id)
        ->whereNotIn('first_name', $first_names)
        ->delete();

        $oathtaking->save();

        return new OathTakingResource($oathtaking);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OathTaking $oathtaking)
    {
        $oathtaking->delete();

        return $this->success('', 'Successfully Deleted',200);
    }
}
