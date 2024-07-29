<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // request에서 email과 password만 가져와 연관배열을 만든다.
        $credentials = $request->only("email","password");  

        // email과 password가 데이터베이스에 있는지 인증한다.
        // 성공한다면 $token에 JWT token 데이터가 담긴다.
        if(!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'ID or password not found'],401);
        }
        
        return response()->json(['token'=> $token],200);
        
    }
    public function register(Request $request){
        // 유저 생성
        try {
            $user = User::create([
                'name' => $request->name,
                'email'=> $request->email,
                'password'=> bcrypt($request->password),
            ]);
        } catch (Exception $e) {
            return response()->json(['errorMessage'=> $e->getMessage()],409);
        }
        

        // 생성된 유저로 Jwt 토큰 발급, 즉 바로 로그인 처리됨
        $token = JWTAuth::fromUser($user);
        return response()->json(['token'=> $token],201);
    }
    public function refresh()
    {
        $token = JWTAuth::getToken();
        if (!$token) {
            return response()->json(['error' => 'token not found'], 401);
        }

        try {
            $newToken = JWTAuth::refresh($token);
        } catch (JWTException $e) {
            return response()->json(['error' => 'token refreshError'], 500);
        }

        return response()->json(['newToken'=> $newToken],201);
    }
    public function me()
    {
        // 프론트에서 헤더에 JWT 토큰을 담아서 보내면, 
        // 그걸 기반으로 사용자 정보를 넘겨준다.
        return response()->json([Auth::user()]);
    }          
    
}
