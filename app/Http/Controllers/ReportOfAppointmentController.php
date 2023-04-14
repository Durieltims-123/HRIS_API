<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreReportOfAppointmentRequest;
use App\Http\Resources\ReportOfAppointmentResource;
use App\Models\ReportAppointment;
use App\Models\ReportOfAppointment;
use App\Traits\HttpResponses;

class ReportOfAppointmentController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ReportOfAppointmentResource::collection(
            ReportOfAppointment::with('hasManyReportAppointment')->get()
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
    public function store(StoreReportOfAppointmentRequest $request)
    {
        $request->validated($request->all());

        $reportOfAppointment = ReportOfAppointment::create([
            "reports" => $request->reports,
            "report_date" => $request->report_date
        ]);

        $appointment_ids = $request->input('appointment_id');

        foreach($appointment_ids as $appointment_id){
            ReportAppointment::create([
                "roa_id" => $reportOfAppointment->id,
                "appointment_id" => $appointment_id
            ]);
        }

        return $this->success('','Successfully Saved',200);
    }

    /**
     * Display the specified resource.
     */
    public function show(ReportOfAppointment $reportOfAppointment)
    {
        return (new ReportOfAppointmentResource($reportOfAppointment->loadMissing('hasManyReportAppointment')));
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
    public function update(Request $request, ReportOfAppointment $reportOfAppointment)
    {
        $reportOfAppointment->reports = $request->reports;
        $reportOfAppointment->report_date = $request->report_date;
        $reportOfAppointment->save();



        return new ReportOfAppointmentResource($reportOfAppointment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReportOfAppointment $reportOfAppointment)
    {
        $reportOfAppointment->delete();
        return $this->success('','Succesfully Deleted','');
    }
}
