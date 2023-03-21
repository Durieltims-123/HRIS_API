<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Requests\StoreProvinceRequest;
use App\Http\Resources\ProvinceResource;
use App\Models\Barangay;
use App\Models\Municipality;
use App\Models\Province;

class ProvinceController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProvinceResource::collection(
            Province::with ('hasOneMunicipality')->get()
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
    public function store(StoreProvinceRequest $request)
    {

        // dd($request);
        // validate input fields
        $request->validated($request->all());

     $province = Province::create([
            "permanent_province_name" => $request->permanent_province_name,
            "residential_province_name" => $request->residential_province_name
        ]);

        $municipality = Municipality::create([
            'province_id' => $province->id,
            "permanent_municipality_name" => $request->permanent_municipality_name,
            "residential_municipality_name" => $request->residential_municipality_name
        ]);

        Barangay::create([
            'municipality_id' => $municipality->id,
            "permanent_barangay_name" => $request->permanent_barangay_name,
            "residential_barangay_name" => $request->residential_barangay_name
        ]);

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
