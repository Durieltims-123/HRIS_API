<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalaryGrades extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function hasOneServiceRecordForm ()
    {
            return $this->hasOne(ServiceRecordForm::class);
    }
    
    protected $fillable = 
    [
        'date_from',
        'date_to',
        'appointment_records',
        'leave_without_pay',
        'remarks',
        'civil_status',
        'designation',
        'salary_annum',
        'office_department',
    ];


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
