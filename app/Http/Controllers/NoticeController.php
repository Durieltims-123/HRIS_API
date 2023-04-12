<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNoticeRequest;
use App\Http\Resources\NoticeResource;
use App\Traits\HttpResponses;

class NoticeController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return NoticeResource::collection(
            Notice::with('belongsToApplication')->get()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoticeRequest $request)
    {
        $request->validated($request->all());
        
        Notice::create([
            "application_id" => $request->application_id,
            "notice_type" => $request->notice_type,
            "date_sent" => $request->date_sent,
            "date_received" => $request->date_received
        ]);

        return $this->success('', 'Successfully Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Notice $notice)
    {
        return (new NoticeResource($notice->loadMissing(['belongsToApplication'])));
        // return new NoticeResource($notice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {   
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreNoticeRequest $request, Notice $notice)
    {
        $notice->application_id = $request->application_id;
        $notice->date_sent = $request->date_sent;
        $notice->notice_type = $request->notice_type;
        $notice->date_received = $request->date_received;

        $notice->save();

        return new NoticeResource($notice);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notice $notice)
    {
        $notice->delete();
        return $this->success('','Successfully Deleted', 200);
    }
}
