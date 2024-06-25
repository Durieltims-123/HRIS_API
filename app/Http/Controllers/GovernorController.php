<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGovernorRequest;
use App\Http\Resources\GovernorResource;
use App\Models\Governor;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class GovernorController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return GovernorResource::collection(
            Governor::all()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGovernorRequest $request)
    {
        // validate input fields
        $request->validated($request->all());

        // validate user from database
        $governor_exist = Governor::where('name', $request->name)->exists();
        if ($governor_exist) {
            return $this->error('', 'Duplicate Entry', 400);
        }

        Governor::create([
            "prefix" => $request->prefix,
            "name" => $request->name,
            "suffix" => $request->suffix
        ]);


        // return message
        return $this->success('', 'Successfully Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Governor $governor)
    {
        return new GovernorResource($governor);
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
    public function update(StoreGovernorRequest $request, Governor $governor)
    {
        $governor->prefix = $request->prefix;
        $governor->name = $request->name;
        $governor->suffix = $request->suffix;
        $governor->save();

        // $governor->update($request->all());
        return new GovernorResource($governor);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Governor $governor)
    {
        $governor->delete();
        return $this->success('', 'Successfully Deleted', 200);
    }
    public function search(Request $request)
    {
        $activePage = $request->activePage;
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $year = $request->year;
        $orderAscending  ? $orderAscending = "asc" : $orderAscending = "desc";
        $orderBy == null ? $orderBy = "id" : $orderBy = $orderBy;
        $filters = $request->filters;
        if (!is_null($filters)) {
            $filters =  array_map(function ($filter) {
                if ($filter['column'] === "id") {
                    return ['governors.id', 'like', '%' . $filter['value'] . '%'];
                } else {
                    return [$filter['column'], 'like', '%' . $filter['value'] . '%'];
                }
            }, $filters);
        } else {
            $filters = [['governors.id', 'like', '%']];
        }

        $data = GovernorResource::collection(
            Governor::where($filters)
                ->skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->take(10)
                ->get()
        );
        $pages =
            Governor::where($filters)
            ->orderBy($orderBy, $orderAscending)
            ->count();

        return compact('pages', 'data');
    }
}
