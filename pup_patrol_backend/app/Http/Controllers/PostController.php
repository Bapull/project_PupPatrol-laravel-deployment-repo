<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(['data'=>new PostCollection(Post::all())]);
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
    public function store(StorePostRequest $request)
    {
        //
        return response()->json(['data'=>new PostResource(Post::create($request->all()))]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return response()->json(['data'=>new PostResource(Post::findOrFail($post->id))],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    
        $userEmail = Auth::user()->email;
        $data = Post::findOrFail($post->id);
        if($data && $data->post_author === $userEmail){
            return response()->json(['data' => $post->update($request->all())]);
        }else{
            return response()->json(['data'=>'unauthorized'],401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $userEmail = Auth::user()->email;
        $data = Post::findOrFail($post->id);
        if($data && $data->post_author === $userEmail){
            return response()->json(['data' => $post->delete()]);
        }else{
            return response()->json(['data'=>'unauthorized'],401);
        }
    }
}
