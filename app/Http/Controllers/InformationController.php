<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInformationRequest;
use App\Http\Requests\UpdateInformationRequest;
use App\Http\Resources\InformationCollection;
use App\Http\Resources\InformationResource;
use App\Models\Information;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $information = new InformationCollection(Information::all());
        return response()->json(['data'=>$information],200);
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
    public function store(StoreInformationRequest $request)
    {
        //
        $information = new InformationResource(Information::create($request->all()));
        return response()->json(['data'=>$information],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Information $information)
    {
        //
        return response()->json(['data'=>new InformationResource(Information::findOrFail($information->id))],200);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Information $information)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInformationRequest $request, Information $information)
    {
        //
        return response()->json(['data'=>$information->update($request->all())],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Information $information)
    {
        //
        return response()->json(['data'=>$information->delete()],200);
    }
}
