<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentCollection;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($postId)
    {
        //
        
        $data = Comment::where('comment_post_id',$postId)->get();
        return response()->json(['data'=>new CommentCollection($data)]);
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
    public function store(StoreCommentRequest $request)
    {
        //
        $comment = new CommentResource(Comment::create($request->all()));
        return response()->json(['data'=>$comment],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
        $data = Comment::findOrFail($comment->id);
        return response()->json(['data'=>new CommentResource($data)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
        
        $userEmail = Auth::user()->email;
        $data = Comment::findOrFail($comment->id);
        if($data && $data->comment_author === $userEmail){
            return response()->json(['data' => $comment->update($request->all())],200);
        }else{
            return response()->json(['data'=>'unauthorized'],401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
        $userEmail = Auth::user()->email;
        $data = Comment::findOrFail($comment->id);
        if($data && $data->comment_author === $userEmail){
            return response()->json(['data' => $comment->delete()],200);
        }else{
            return response()->json(['data'=>'unauthorized'],401);
        }
    }
}
