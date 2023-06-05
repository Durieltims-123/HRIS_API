<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSalaryGradeRequest;
use App\Http\Resources\SalaryGradeResource;
use App\Models\Position;
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
        )->toJson();
    }



    public function search(Request $request)
    {
        $activePage = $request->activePage;
        $searchKeyword = $request->searchKeyword;
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $orderAscending  ? $orderAscending = "asc" : $orderAscending = "desc";
        $searchKeyword == null ? $searchKeyword = "" : $searchKeyword = $searchKeyword;
        $orderBy == null ? $orderBy = "id" : $orderBy = $orderBy;

        $data = SalaryGradeResource::collection(
            SalaryGrade::where("id", "like", "%" . $searchKeyword . "%")
                ->orWhere("number", "like", "%" . $searchKeyword . "%")
                ->orWhere("amount", "like", "%" . $searchKeyword . "%")
                ->skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->take(10)
                ->get()
        );
        $pages = SalaryGrade::where("id", "like", "%" . $searchKeyword . "%")
            ->orWhere("number", "like", "%" . $searchKeyword . "%")
            ->orWhere("amount", "like", "%" . $searchKeyword . "%")
            ->orderBy($orderBy, $orderAscending)
            ->count();

        return compact('pages', 'data');
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
        $salaryGradeExist = SalaryGrade::where([['number', $request->number]])->exists();
        if ($salaryGradeExist) {
            return $this->error('', 'Duplicate Number Entry', 400);
        }

        SalaryGrade::create([
            "number" => $request->number,
            "amount" => $request->amount
        ]);


        // return message
        return $this->success('', 'Successfully Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(SalaryGrade $salaryGrade)
    {
        return $salaryGrade;
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
        $duplicate = SalaryGrade::where([["number", $request->number], ['id', '<>', $salaryGrade->id]])->exists();
        if ($duplicate) {
            return $this->error('', 'Duplicate Number Entry', 400);
        }
        $salaryGrade->amount = $request->amount;
        $salaryGrade->number = $request->number;
        $salaryGrade->save();
        return new SalaryGradeResource($salaryGrade);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalaryGrade $salaryGrade)
    {
        $positionExist=Position::where('salary_grade_id',$salaryGrade->id)->exists();
        if ($positionExist) {
            return $this->error('', 'You cannot delete Salary Grade  connected to a position.', 400);
        } else {
            $salaryGrade->delete();
            return $this->success('', 'Successfully Deleted', 200);
        }
    }
}
