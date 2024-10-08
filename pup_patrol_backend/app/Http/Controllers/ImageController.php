<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /** 
 * @OA\post(
 *     path="/api/imageUpload",
 *     tags={"image"},
 *     summary="s3버킷에 이미지 추가",
 *     description="s3버킷에 이미지를 추가하고 추가된 파일명을 반환함",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="image"
 *         )
 *     ),
 *     @OA\Parameter(
*         name="folder",
*          description="이미지가 저장될 폴더명",
*         in="header",
*         required=true,
*         example="pup-patrol-information-image",
*     @OA\Schema(type="sting")
* ),
 *     @OA\Response(response="201", description="이미지가 s3버킷에 업로드 됨"),
*     @OA\Response(response="401", description="권한 없음")
 * )
 **/
    public function upload(Request $request){
        try {
            // 파일 검증
            $request->validate([
                'image' => 'required|image|mimes:jpg,jpeg,png,gif',
            ]);

            // 파일 이름 설정
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            // 파일 폴더 설정
            $folder = $request->header('folder');
            if($folder == 'pup-patrol-information-image'){
                if(Auth::user()->role != 'admin' ){
                    return response()->json(['data' => 'unauthorized'],401);
                }
            }
            // 파일 저장
            if(!Storage::disk('s3')->put("/{$folder}/{$fileName}", file_get_contents($request->file('image')))){
                // 실패했을때 실패했다고 알려줌
                return response()->json(['data'=>'fail'],400);
            };
            // 성공하면 나중에 접근할 수 있도록, 파일 이름을 응답으로 줍니다.
            return response()->json(['data' => "{$fileName}"], 201);
        } catch (\Exception $e) {
            return response()->json(['data' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
/** 
 * @OA\get(
 *     path="/api/imageDownload",
 *     tags={"image"},
 *     summary="파일이름과 폴더이름을 사용해서 이미지 url을 받아옴",
 *     description="파일이름은 쿼리로 폴더이름은 헤더에서 받음",
 *       @OA\Parameter(
*     name="fileName",
*     description="파일명",
*     in="query",
*     required=true,
*     example="172394_프로필사진.jpg",
*     @OA\Schema(type="sting")
* ),
*     @OA\Parameter(
*     name="folder",
*     description="폴더명",
*     in="header",
*     required=true,
*     example="pup-patrol-information-image",
*     @OA\Schema(type="sting")
* ),
 *     @OA\Response(response="200", description="success")
 * )
 **/
    public function download(Request $request){
        // 파일 이름 검증
        $request->validate([
            'fileName' => 'required|string',
        ]);

        $fileName = $request->query('fileName');
        $folder = $request->header('folder');
        
        // 10분동안 작동하는 임시 url을 만들어서 프론트에게 줍니다.
        $url = Storage::disk('s3')->temporaryUrl(
            "/{$folder}/{$fileName}", now()->addMinutes(10)
        );

        return response()->json(['data' => $url], 200);
    }
/** 
 * @OA\delete(
 *     path="/api/imageDelete",
 *     tags={"image"},
 *     summary="s3버킷에 이미지 삭제",
 *     description="s3버킷에 이미지를 삭제함",
 *       @OA\Parameter(
*     name="fileName",
*     description="파일명",
*     in="query",
*     required=true,
*     example="172394_프로필사진.jpg",
*     @OA\Schema(type="sting")
* ),
*     @OA\Parameter(
*     name="folder",
*     description="폴더명",
*     in="header",
*     required=true,
*     example="pup-patrol-information-image",
*     @OA\Schema(type="sting")
* ),
 *     @OA\Response(response="201", description="이미지가 s3버킷에서 삭제됨"),
*     @OA\Response(response="401", description="권한 없음")
 * )
 **/
    public function destroy(Request $request){
        try {
            // 파일 이름 검증
            $request->validate([
                'fileName' => 'required|string',
            ]);

            $fileName = $request->query('fileName');
            $folder = $request->header('folder');
            if($folder == 'pup-patrol-information-image'){
                if(Auth::user()->role != 'admin' ){
                    return response()->json(['data' => 'unauthorized'],401);
                }
            }
            // 이미지 삭제
            Storage::disk('s3')->delete("{$folder}/{$fileName}");

            return response()->json(['data' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
