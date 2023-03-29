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
            Province::with('hasOneMunicipality')->get()
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
            "province_name" => $request->province_name,
            "province_code" => $request->province_code
        ]);

        $municipality = Municipality::create([
            'province_id' => $province->id,
            "municipality_name" => $request->municipality_name,
            "municipality_code" => $request->municipality_code,
        ]);

        Barangay::create([
            'municipality_id' => $municipality->id,
            "barangay_name" => $request->barangay_name,
            "barangay_code" => $request->barangay_code,
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
    public function destroy(Province $province)
    {
        $province->delete();
        return $this->success('', 'Successfull Deleted', 200);
    }
}
