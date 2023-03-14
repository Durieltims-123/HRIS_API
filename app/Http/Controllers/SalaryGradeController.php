<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSalaryGradeRequest;
use App\Http\Resources\SalaryGradeResource;
use App\Models\SalaryGrade;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class SalaryGradeController extends Controller
{
use HttpResponses; 
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SalaryGradeResource::collection(
            SalaryGrade::all()
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
    public function store(StoreSalaryGradeRequest $request)
    {
       // validate input fields
        $request->validated($request->all());

        // validate user from database
        $salaryGradeExist = SalaryGrade::where([['number', $request->number], ['amount', $request->amount]])->exists();
        if ($salaryGradeExist) {
            return $this->error('', 'Duplicate Entry', 400);
        }

        SalaryGrade::create([
            "number" => $request->number,
            "amount" => $request->amount
        ]);


        // return message
        return $this->success('', 'Successfull Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(SalaryGrade $salaryGrade)
    {
        
        // return new SalaryGradeResource($salaryGrade);
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
    public function update(Request $request, SalaryGrade $salaryGrade)
    {
        //  dd($request->number);
                   
            $salaryGrade->amount = $request->amount;
            $salaryGrade->number = $request->number;
            $salaryGrade->save();
    
            // $holiday->update($request->all());
            return new SalaryGradeResource($salaryGrade);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalaryGrade $salaryGrade)
    { 
        $salaryGrade->delete();
        return $this->success('', 'Successfull Deleted', 200);
    }
}
