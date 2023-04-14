<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRecordFormRequest;
use App\Http\Resources\ServiceRecordFormResource;
use App\Models\ServiceRecordForm;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class ServiceRecordFormController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ServiceRecordFormResource::collection(
            ServiceRecordForm::all()
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
    public function store(ServiceRecordFormRequest $request)
    {
        // validate input fields
        $request->validated($request->all());

        ServiceRecordForm::create([
            "employee_id" => $request->employee_id,
            'date_from' => Date('Y-m-d', strtotime($request->date_from)),
            'date_to' => Date('Y-m-d', strtotime($request->date_to)),
            "appointment_records" => $request->appointment_records,
            "leave_without_pay" => $request->leave_without_pay,
            "remarks" => $request->remarks,
            "civil_status" => $request->civil_status,
            "designation" => $request->designation,
            "salary_annum" => $request->salary_annum,
            "office_department" => $request->office_department
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
    public function update(Request $request, ServiceRecordForm $serviceRecordForm)
    {
        $serviceRecordForm->date_from = Date('Y-m-d', strtotime($request->date_from));
        $serviceRecordForm->date_to = Date('Y-m-d', strtotime($request->date_to));
        $serviceRecordForm->appointment_records = $request->appointment_records;
        $serviceRecordForm->leave_without_pay = $request->leave_without_pay;
        $serviceRecordForm->remarks = $request->remarks;
        $serviceRecordForm->civil_status = $request->civil_status;
        $serviceRecordForm->designation = $request->designation;
        $serviceRecordForm->salary_annum = $request->salary_annum;
        $serviceRecordForm->office_department = $request->office_department;
        $serviceRecordForm->save();

        // $holiday->update($request->all());
        return new ServiceRecordFormResource($serviceRecordForm);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceRecordForm $serviceRecordForm)
    {
        $serviceRecordForm->delete();
        return $this->success('', 'Successfull Deleted', 200);
    }
}
