<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\ReportOfAppointment;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AppointmentResource::collection(
            Appointment::with('belongsToApplication')->get()
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
    public function store(StoreAppointmentRequest $request)
    {
       
        $request->validated($request->all());

        $appointmentExist = Appointment::where('application_id',$request->application_id)->exists();
        if($appointmentExist){
            return $this->error('','Duplicate Entry', 200);
        }
        
        Appointment::create([
            'application_id' => $request->application_id,
            'appointment_date' => $request->appointment_date
        ]);

        return $this->success('','Successfully Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        return (new AppointmentResource($appointment->loadMissing('belongsToApplication')));
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
    public function update(Request $request, Appointment $appointment)
    {
        $appointment->application_id = $request->application_id;
        $appointment->appointment_date = $request->appointment_date;
        $appointment->save();

        return new AppointmentResource($appointment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return $this->success('','Successfully Deleted',200);
    }
}
