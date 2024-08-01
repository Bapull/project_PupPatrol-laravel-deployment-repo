<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(Request $request){
        try {
            // 파일 검증
            $request->validate([
                'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            ]);

            // 파일 이름 설정
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            // 파일 폴더 설정
            $folder = $request->header('folder');
            // 파일 저장
            if(!Storage::disk('s3')->put("/{$folder}/{$fileName}", file_get_contents($request->file('image')))){
                // 실패했을때 실패했다고 알려줌
                return response()->json(['data'=>'fail'],400);
            };
            // 성공하면 나중에 접근할 수 있도록, 파일 이름을 응답으로 줍니다.
            return response()->json(['data' => "/{$fileName}"], 201);
        } catch (\Exception $e) {
            return response()->json(['data' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

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

    public function destroy(Request $request){
        try {
            // 파일 이름 검증
            $request->validate([
                'fileName' => 'required|string',
            ]);

            $fileName = $request->query('fileName');
            $folder = $request->header('folder');
            // 이미지 삭제
            Storage::disk('s3')->delete("{$folder}/{$fileName}");

            return response()->json(['data' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
