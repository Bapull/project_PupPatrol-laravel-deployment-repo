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
 * @OA\get(
 *     path="/api/posts",
 *     tags={"post"},
 *     summary="posts 테이블",
 *     description="posts 테이블에 등록된 모든 데이터를 data라는 키를 가진 배열로 반환",
 *      
 *     @OA\Response(response="200", description="success")
 * )
 **/
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
 * @OA\post(
 *     path="/api/posts",
 *     tags={"post"},
 *     summary="posts 테이블에 데이터 추가",
 *     description="posts 테이블에 데이터를 추가함",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="postTitle", type="string", description="게시글 제목", example="title" ),
 *                 @OA\Property(property="postContent", type="string", description="게시글 내용", example=" [\'ddd\',\'(IMAGE)1725807499_pome.jpg\',\'ddd\'] (배열 형태의 텍스트여야 함, 배열의 요소 중 (IMAGE) 가 붙은 건 이미지 이므로 앞의 (IMAGE)를 떼고 남은 파일 이름을 api/imageDownload 에 요청을 보내서 이미지 링크로 받아와야 함)" )
 *             )
 *         )
 *     ),
 *     @OA\Response(response="201", description="게시글이 성공적으로 추가됨")
 * )
 **/
    public function store(StorePostRequest $request)
    {
        //
        return response()->json(['data'=>new PostResource(Post::create($request->all()))]);
    }

    /** 
 * @OA\get(
 *     path="/api/posts/{post}",
 *     tags={"post"},
 *     summary="파라미터로 넘어온 id를 가지는 특정 post 데이터 조회",
 *     description="파라미터로 넘어온 id를 가지는 특정 post 데이터를 data라는 키를 가진 객체로 반환",
 *      @OA\Parameter(
 *          name="post",
 *          description="post의 id",
 *          in="path",
 *          required=true,
 *          example="1",
 *          @OA\Schema(type="json")
 *     ),
 *     @OA\Response(response="200", description="하나의 post 데이터")
 * )
 **/
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
 * @OA\put(
 *     path="/api/posts/{post}",
 *     tags={"post"},
 *     summary="post데이터 수정",
 *     description="로그인 한 정보와 글 작성자가 같다면 post데이터를 수정함 ",
 *     @OA\Parameter(
 *          name="post",
 *          description="post의 아이디",
 *          in="path",
 *          required=true,
 *          example="1",
 *          @OA\Schema(type="string")
 *     ),
 *      @OA\RequestBody(
 *          @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *                 @OA\Property(property="postTitle", type="string", description="게시글 제목", example="title" ),
 *                 @OA\Property(property="postContent", type="string", description="게시글 내용", example="[\'ddd\',\'(IMAGE)1725807499_pome.jpg\',\'ddd\'] (배열 형태의 텍스트여야 함, 배열의 요소 중 (IMAGE) 가 붙은 건 이미지 이므로 앞의 (IMAGE)를 떼고 남은 파일 이름을 api/imageDownload 에 요청을 보내서 이미지 링크로 받아와야 함)" )
 *          )
 *      )
 * ),
 *     @OA\Response(response="200", description="수정이 된 경우"),
 *     @OA\Response(response="401", description="로그인된 정보와 글 작성자가 일치하지 않을 경우")
 * )
 **/
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
 * @OA\delete(
 *     path="/api/posts/{post}",
 *     tags={"post"},
 *     summary="특정 post 데이터 삭제",
 *     description="로그인한 정보와 글 작성자가 같다면 post를 삭제함",
 *      @OA\Parameter(
 *          name="post",
 *          description="post의 id",
 *          in="path",
 *          required=true,
 *          example="1",
 *          @OA\Schema(type="json")
 *     ),
 *     @OA\Response(response="200", description="post 삭제에 성공한 경우"),
 *     @OA\Response(response="401", description="로그인된 정보와 글 작성자가 일치하지 않을 경우")
 * )
 **/
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
