<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfficeRequest;
use App\Http\Resources\OfficeResource;
use App\Models\Office;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OfficeResource::collection(
            Office::all()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfficeRequest $request)
    {
        // 
        $request->validated($request->all());

        $officeExist = Office::where([['office_code', $request->office_code], ['office_name', $request->office_name]])->exists();
        if ($officeExist) {
            return $this->error('', 'Duplicate Entry', 400);
        }
        Office::create([
            "office_code" => $request->office_code,
            "office_name" => $request->office_name,
        ]);
        // $office=new Office();
        // $office-> office_code=$request->office_code;
        // $office-> office_name=$request->office_name;
        // $office->save();
 
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
    public function update(Request $request, Office $office)
    {
        $office->office_code = $request->office_code;
        $office->office_name = $request->office_name;
        $office->save();

        return new OfficeResource($office);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Office $office)
    {
        $office->delete();
        return $this->success('', 'Successfull Deleted', 200);
    }

    public function search(Request $request){

        $activePage = $request->activePage;
        $searchKeyword = $request->searchKeyword;
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $orderAscending  ? $orderAscending = "asc" : $orderAscending = "desc";
        $searchKeyword == null ? $searchKeyword = "" : $searchKeyword = $searchKeyword;
        $orderBy == null ? $orderBy = "id" : $orderBy = $orderBy;

        $data = OfficeResource::collection(
            Office::where("id", "like", "%" . $searchKeyword . "%")
                ->orWhere("office_name", "like", "%" . $searchKeyword . "%")
                ->orWhere("office_code", "like", "%" . $searchKeyword . "%")
                ->skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->take(10)
                ->get()
        );
        $pages = Office::where("id", "like", "%" . $searchKeyword . "%")
            ->orWhere("office_name", "like", "%" . $searchKeyword . "%")
            ->orWhere("office_code", "like", "%" . $searchKeyword . "%")
            ->orderBy($orderBy, $orderAscending)
            ->count();

        return compact('pages', 'data');
        
    }
}
