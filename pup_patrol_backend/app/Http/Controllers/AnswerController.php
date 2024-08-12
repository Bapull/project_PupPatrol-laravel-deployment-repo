<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnswerCollection;
use App\Http\Resources\AnswerResource;
use App\Models\Answer;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        //
        $answers = new AnswerCollection(Answer::all());
        return response()->json(['data'=> $answers],200);
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
    public function store(StoreAnswerRequest $request)
    {
        //
        
        $answer = new AnswerResource(Answer::create($request->all()));
        return response()->json(['data'=> $answer],201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        //
        return response()->json(['data'=> new AnswerResource(Answer::findOrFail($answer->id))],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnswerRequest $request, Answer $answer)
    {
        //
        return response()->json(['data'=> $answer->update($request->all())],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        //
        return response()->json(['data'=> $answer->delete()],200);
    }
}
