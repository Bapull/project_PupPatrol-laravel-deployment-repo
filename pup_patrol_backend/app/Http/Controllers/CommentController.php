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
 * @OA\get(
 *     path="/api/comments/{postId}",
 *     tags={"comment"},
 *     summary="특정 게시글의 댓글 반환",
 *     description="파라미터로 받은 postId와 comments 테이블의 postId열이 일치하는 정보들을 data라는 키를 가진 배열로 반환",
 *      @OA\Parameter(
 *          name="postId",
 *          description="post의 id",
 *          in="path",
 *          required=true,
 *          example="1",
 *          @OA\Schema(type="json")
 *     ),
 *     @OA\Response(response="200", description="success")
 * )
 **/
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
 * @OA\post(
 *     path="/api/comments",
 *     tags={"comment"},
 *     summary="댓글 추가",
 *     description="comments 테이블에 데이터를 추가함",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="commentPostId", type="int", description="댓글이 달린 게시글 id", example="1" ),
 *                 @OA\Property(property="commentContent", type="string", description="댓글 내용", example="안녕하세요" )
 * 
 *             )
 *         )
 *     ),
 *     @OA\Response(response="201", description="answer이 성공적으로 추가됨")
 * )
 **/
    public function store(StoreCommentRequest $request)
    {
        //
        $comment = new CommentResource(Comment::create($request->all()));
        return response()->json(['data'=>$comment],201);
    }

    /** 
 * @OA\get(
 *     path="/api/comments/{comment}",
 *     tags={"comment"},
 *     summary="파라미터로 넘어온 id를 가지는 특정 comment 데이터 조회",
 *     description="파라미터로 넘어온 id를 가지는 특정 comment 데이터를 data라는 키를 가진 객체로 반환",
 *      @OA\Parameter(
 *          name="comment",
 *          description="comment의 id",
 *          in="path",
 *          required=true,
 *          example="1",
 *          @OA\Schema(type="json")
 *     ),
 *     @OA\Response(response="200", description="특정 댓글 데이터")
 * )
 **/
    public function show(Comment $comment)
    {
        //
        $data = Comment::findOrFail($comment->id);
        return response()->json(['data'=>new CommentResource($data)]);
    }

    /** 
 * @OA\patch(
 *     path="/api/comments/{comment}",
 *     tags={"comment"},
 *     summary="comment 데이터 수정",
 *     description="로그인 한 정보와 댓글 작성자가 같다면 comment 데이터를 수정함 ",
 *     @OA\Parameter(
 *          name="comment",
 *          description="comment의 아이디",
 *          in="path",
 *          required=true,
 *          example="1",
 *          @OA\Schema(type="string")
 *     ),
 *      @OA\RequestBody(
 *          @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *                 @OA\Property(property="commentPostId", type="int", description="댓글이 달린 게시글 id", example="1" ),
 *                 @OA\Property(property="commentContent", type="string", description="댓글 내용", example="안녕하세요" )
 *          )
 *      )
 * ),
 *     @OA\Response(response="200", description="수정이 된 경우"),
 *     @OA\Response(response="401", description="로그인된 정보와 댓글 작성자가 일치하지 않을 경우")
 * )
 **/
    public function edit(Comment $comment)
    {
        //
    }

    /** 
 * @OA\put(
 *     path="/api/comments/{comment}",
 *     tags={"comment"},
 *     summary="comment 데이터 수정",
 *     description="로그인 한 정보와 댓글 작성자가 같다면 comment 데이터를 수정함 ",
 *     @OA\Parameter(
 *          name="comment",
 *          description="comment의 아이디",
 *          in="path",
 *          required=true,
 *          example="1",
 *          @OA\Schema(type="string")
 *     ),
 *      @OA\RequestBody(
 *          @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *                 @OA\Property(property="commentPostId", type="int", description="댓글이 달린 게시글 id", example="1" ),
 *                 @OA\Property(property="commentContent", type="string", description="댓글 내용", example="안녕하세요" )
 *          )
 *      )
 * ),
 *     @OA\Response(response="200", description="수정이 된 경우"),
 *     @OA\Response(response="401", description="로그인된 정보와 댓글 작성자가 일치하지 않을 경우")
 * )
 **/
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
 * @OA\delete(
 *     path="/api/comments/{comment}",
 *     tags={"comment"},
 *     summary="특정 comment 데이터 삭제",
 *     description="로그인한 정보와 댓글 작성자가 같다면 comment를 삭제함",
 *      @OA\Parameter(
 *          name="comment",
 *          description="comment의 id",
 *          in="path",
 *          required=true,
 *          example="1",
 *          @OA\Schema(type="json")
 *     ),
 *     @OA\Response(response="200", description="comment 삭제에 성공한 경우"),
 *     @OA\Response(response="401", description="로그인된 정보와 댓글 작성자가 일치하지 않을 경우")
 * )
 **/
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
