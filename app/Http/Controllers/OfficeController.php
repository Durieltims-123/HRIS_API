<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfficeRequest;
use App\Http\Resources\OfficeResource;
use App\Models\Office;
use App\Models\Division;
use App\Models\LguPosition;
use App\Models\Position;
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
        $officeExist = Office::where('office_code', $request->office_code)->orWhere('office_name', $request->office_name)->exists();
        if ($officeExist) {
            return $this->error('', 'Duplicate Entry', 400);
        } else {
            $office = Office::create([
                'office_code' => $request->office_code,
                'office_name' => $request->office_name,
            ]);

            return $this->success('', 'Successfully Saved', 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Office $office)
    {
        return $office;
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
    public function update(StoreOfficeRequest $request, Office $office)
    {
        $office->office_code = $request->office_code;
        $office->office_name = $request->office_name;
        $office_codes = $request->input('office_code');
        $office_names = $request->input('office_name');
        $office->save();

        return new OfficeResource($office);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Office $office)
    {
        // validate user from database
        $divisionExist = Division::where([['office_id', $office->id]])->exists();
        if ($divisionExist) {
            return $this->error('', 'You cannot delete Office with existing divisions.', 400);
        } else {
            $office->delete();
            return $this->success('', 'Successfully Deleted', 200);
        }
    }

    public function search(Request $request)
    {
        $activePage = $request->activePage;
        $filters = $request->filters;
        $fill = $request->filters;
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $orderAscending  ? $orderAscending = "asc" : $orderAscending = "desc";
        if (!is_null($filters)) {
            $filters =  array_map(function ($filter) {
                if ($filter['column'] === "id") {
                    return ['offices.id', 'like', '%' . $filter['value'] . '%'];
                } else {
                    return [$filter['column'], 'like', '%' . $filter['value'] . '%'];
                }
            }, $filters);
        } else {
            $filters = [['offices.id', 'like', '%']];
        }


        $orderBy == null ? $orderBy = "id" : $orderBy = $orderBy;

        $data = OfficeResource::collection(
            Office::skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->with('divisions')
                ->where($filters)
                ->take(10)
                ->get()
        );
        $pages = Office::where($filters)
            ->orderBy($orderBy, $orderAscending)
            ->count();

        return compact('pages', 'data', 'fill');
    }
}
