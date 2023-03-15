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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfficeRequest $request)
    {
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
}
