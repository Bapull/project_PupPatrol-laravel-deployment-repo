<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Tips;
use App\Http\Requests\StoreTipsRequest;
use App\Http\Resources\TipsResource;

class TipsController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }
    public function store(StoreTipsRequest $request)
    {
        //
        return response()->json(['data'=>new TipsResource(Tips::create($request->all()))]);
    }
    public function update()
    {
        //
    }
    public function destroy()
    {
        //
    }
}
