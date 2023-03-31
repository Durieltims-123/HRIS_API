<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return QuestionResource::collection(
            Question::all()
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
    public function store(StoreQuestionRequest $request)
    {
        // validate input fields
        $request->validated($request->all());

        Question::create([
            "number" => $request->number,
            "questions" => $request->questions,

        ]);


        // return message
        return $this->success('', 'Successfull Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        return QuestionResource::collection(
            Question::where('id',$question->id)
            ->get()
            );
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
    public function update(Request $request, Question $question)
    {
        $question->number = $request->number;
        $question->questions = $request->questions;
        $question->save();

        return new QuestionResource($question);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return $this->success('', 'Successfull Deleted', 200);
    }
}
