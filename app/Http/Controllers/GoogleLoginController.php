<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GoogleLoginController extends Controller
{
    public function handleGoogleCallback(Request $request)
    {
        $token = $request->input('access_token');

        try {
            // 토큰을 통해 사용자 정보를 가져옵니다
            $googleUser = Socialite::driver('google')->userFromToken($token);
            $findUser = User::where('email', $googleUser->getEmail())->first();

            // 유저가 존재하면 로그인만 
            if ($findUser) {
                Auth::login($findUser);
            } else {
                // 사용자 데이터로 사용자 모델을 찾거나 생성합니다
                $newUser = User::Create(
                    [
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        // 비밀번호는 Google OAuth에서는 제공되지 않으므로 빈 문자열 또는 null로 설정
                        'password' => ''
                    ]
                );
                // 사용자 로그인
                Auth::login($newUser);
            }   
            return response()->json(['user'=>Auth::user()]); // 로그인 후 응답
        } 
        
        catch (\Exception $e) {
            return response()->json(['error' => 'Failed to authenticate user'], 500);
        }
    }
}
