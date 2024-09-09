<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserUpdateController extends Controller
{
    /** 
 * @OA\patch(
 *     path="/api/user-update",
 *     tags={"user"},
 *     summary="user데이터 수정",
 *     description="현재 로그인 된 유저의 name, birthday, profile_picture을 requestBody에 있는 정보로 업데이트 한다. ",
 *      @OA\RequestBody(
 *          @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *                 @OA\Property(property="birthday", type="date", description="바꾸고자 하는 생일", example="2024-09-09" ),
 *                 @OA\Property(property="profilePicture", type="string", description="api/imageUpload의 결과로 반환된 프로필 사진의 파일명", example="1725465_셀카.jpg" ),
 *                 @OA\Property(property="name", type="string", description="바꾸고자 하는 닉네임", example="z지존x어둠z" ),
 *          )
 *      )
 * ),
 *     @OA\Response(response="200", description="수정이 된 경우"),
 *     @OA\Response(response="401", description="로그인이 안 된 경우")
 * )
 **/
    public function update(Request $request){
        try{
            $user = Auth::user();
            if($request->birthday){
                $user->birthday = $request->birthday;
            }
            if($request->profilePicture){
                $user->profile_picture = $request->profilePicture;
            }
            if($request->name){
                $user->name = $request->name;
            }
            $user->save();
            return response()->json(['data'=>'success']);
        }catch(Exception){
            return response()->json(['data'=>'unauthorized']);
        }
        
    }
}
