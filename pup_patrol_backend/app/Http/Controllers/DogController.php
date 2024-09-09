<?php

namespace App\Http\Controllers;

use App\Http\Resources\DogCollection;
use App\Http\Resources\DogResource;
use App\Models\Dog;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDogRequest;
use App\Http\Requests\UpdateDogRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DogController extends Controller
{
    /** 
 * @OA\get(
 *     path="/api/dogs",
 *     tags={"dog"},
 *     summary="로그인된 계정에 등록된 반려견 전부 조회",
 *     description="현재 로그인 된 사람이 등록한 반려견의 정보를 data라는 키를 가진 배열로 반환",
 *      
 *     @OA\Response(response="200", description="success")
 * )
 **/
   
    public function index()
    {
        //
        $data = Dog::where('dog_owner_email',Auth::user()->email)->get();
        return response()->json(['data'=>new DogCollection($data)]);
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
 *     path="/api/dogs",
 *     tags={"dog"},
 *     summary="dog에 데이터 추가",
 *     description="dog에 데이터를 추가함",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="dogName", type="string", description="반려견 이름", example="뽀삐" ),
 *                 @OA\Property(property="dogBreed", type="string", description="반려견의 종", example="푸들" ),
 *                 @OA\Property(property="dogBirthDate", type="date", description="반려견의 생일", example="2024-3-2" ),
 *                 @OA\Property(property="dogPhotoName", type="string", description="api/imageUpload 의 응답으로 나온 파일명", example="172834_뽀삐사진.jpg" )
 *                 
 * 
 *             )
 *         )
 *     ),
 *     @OA\Response(response="201", description="반려견 정보가 성공적으로 추가됨")
 * )
 **/
    public function store(StoreDogRequest $request)
    {
        //
        $dog = new DogResource(Dog::create($request->all()));
        return response()->json(['data'=>$dog],201);
    }

        /** 
 * @OA\get(
 *     path="/api/dogs/{dog}",
 *     tags={"dog"},
 *     summary="반려견 조회",
 *     description="파라미터로 받은 반려견의 id가 현재 로그인 된 사람이 등록한게 맞다면 해당 반려견 객체를 리턴함",
 *      @OA\Parameter(
 *          name="dog",
 *          description="이용자가 등록한 반려견의 id",
 *          in="path",
 *          required=true,
 *          example="1",
 *          @OA\Schema(type="json")
 *     ),
 *     @OA\Response(response="200", description="success"),
 *     @OA\Response(response="401", description="본인의 반려견이 아님"),
 * 
 * )
 **/
    public function show(Request $request,Dog $dog)
    {
        //
        $userEmail = Auth::user()->email;
        $data = Dog::findOrFail($dog->id);
        if($data && $data->dog_owner_email === $userEmail){
            return response()->json(['data'=>new DogResource(Dog::findOrFail($dog->id))],200);
        }else{
            return response()->json(['data'=>'unauthorized'],401);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dog $dog)
    {
        //
        
    }   

     /** 
 * @OA\put(
 *     path="/api/dogs/{dog}",
 *     tags={"dog"},
 *     summary="반려견 데이터 수정",
 *     description="파라미터로 넘어온 id가 로그인 한 사람이 등록한 반려견이 맞다면 반려견의 데이터를 수정함 ",
 *     @OA\Parameter(
 *          name="dag",
 *          description="반려견의 아이디",
 *          in="path",
 *          required=true,
 *          example="1",
 *          @OA\Schema(type="string")
 *     ),
 *      @OA\RequestBody(
 *          @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *              @OA\Property(property="dogName", type="string", description="반려견 이름", example="뽀삐" ),
 *              @OA\Property(property="dogBreed", type="string", description="반려견의 종", example="푸들" ),
 *              @OA\Property(property="dogBirthDate", type="date", description="반려견의 생일", example="2024-3-2" ),
 *              @OA\Property(property="dogPhotoName", type="string", description="api/imageUpload 의 응답으로 나온 파일명", example="172834_뽀삐사진.jpg" )
 *          )
 *      )
 * ),
 *     @OA\Response(response="200", description="수정이 된 경우"),
  *     @OA\Response(response="401", description="본인의 반려견이 아님")
 * )
 **/
    public function update(UpdateDogRequest $request, Dog $dog)
    {
        //
        
        $userEmail = Auth::user()->email;
        $data = Dog::findOrFail($dog->id);
        if($data && $data->dog_owner_email === $userEmail){
            return response()->json(['data' => $dog->update($request->all())],200);
        }else{
            return response()->json(['data'=>'unauthorized'],401);
        }
        
    }

       /** 
 * @OA\delete(
 *     path="/api/dogs/{dog}",
 *     tags={"dog"},
 *     summary="특정 dog 데이터 삭제",
 *     description="하나의 반려견 정보를 삭제함",
 *      @OA\Parameter(
 *          name="dog",
 *          description="파라미터로 넘어온 id가 로그인 한 사람이 등록한 반려견이 맞다면 반려견의 데이터를 삭제함 ",
 *          in="path",
 *          required=true,
 *          example="1",
 *          @OA\Schema(type="json")
 *     ),
 *     @OA\Response(response="200", description="데이터 삭제에 성공한 경우"),
  *     @OA\Response(response="401", description="본인의 반려견이 아님")
 * )
 **/
    public function destroy(Request $request, Dog $dog)
    {
        //
        $userEmail = Auth::user()->email;
        $data = Dog::findOrFail($dog->id);
        if($data && $data->dog_owner_email === $userEmail){
            return response()->json(['data'=>$dog->delete()],200);
        }else{
            return response()->json(['data'=>'unauthorized'],401);
        }
        
        
    }
}
