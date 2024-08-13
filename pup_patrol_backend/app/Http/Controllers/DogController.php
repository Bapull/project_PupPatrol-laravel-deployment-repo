<?php

namespace App\Http\Controllers;

use App\Http\Resources\DogCollection;
use App\Http\Resources\DogResource;
use App\Models\Dog;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDogRequest;
use App\Http\Requests\UpdateDogRequest;
use Illuminate\Http\Request;

class DogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $userEmail = $request->user()->email;
        $dogs = new DogCollection(Dog::where('dog_owner_email','=',$userEmail));
        return response()->json(['data'=>$dogs],200);
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
    public function store(StoreDogRequest $request)
    {
        //
        $dog = new DogResource(Dog::create($request->all()));
        return response()->json(['data'=>$dog],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,Dog $dog)
    {
        //
        $userEmail = $request->user()->email;
        $data = Dog::where('dog_owner_email','=',$userEmail,'and','id','=',$dog->id);
        
        return response()->json(['data'=>new DogResource($data)],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dog $dog)
    {
        //
        
    }   

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDogRequest $request, Dog $dog)
    {
        //
        return response()->json(['data' => $dog->update($request->all())],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Dog $dog)
    {
        //
        $target = Dog::findOrFail($dog->id);
        if($request->user()->email == $target->dog_owner_email){
            return response()->json(['data'=>$dog->delete()],200);
        }else{
            return response()->json(['data'=>'Unauthorized'],401);
        }
        
    }
}
