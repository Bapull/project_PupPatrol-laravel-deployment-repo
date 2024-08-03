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

        // access_token이 null인지 확인
        if (is_null($token)) {
            return response()->json(['error' => 'Access token is missing'], 400);
        }

        // try {
            // 토큰을 통해 사용자 정보를 가져옵니다
            $googleUser = Socialite::driver('google')->userFromToken($token);

            // 사용자 데이터로 사용자 모델을 찾거나 생성합니다
            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    // 이름을 못가져옴 
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    // 비밀번호는 Google OAuth에서는 제공되지 않으므로 빈 문자열 또는 null로 설정
                    'password' => ''
                ]
            );

            // 사용자 로그인
            Auth::login($user);

            return redirect()->intended('/home'); // 리디렉션 경로를 실제 경로로 수정

        // } 
        // catch (\Exception $e) {
        //     return response()->json(['error' => 'Failed to authenticate user'], 500);
        // }
    }
}
