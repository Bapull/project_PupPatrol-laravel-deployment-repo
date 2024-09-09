<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /** 
 * @OA\get(
 *     path="/api/user",
 *     tags={"user"},
 *     summary="현재 로그인된 유저정보를 반환함",
 *     description="유저의 name, profile_picture, email, role, birthday 를 반환함",
 *      
 *     @OA\Response(response="200", description="success")
 * )
 **/
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        // 이 컨트롤러가 api/user로 오는 요청을 처리하지는 않지만 문서화를 위해서
        // 여기에 작성했습니다. 
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('/dashboard');
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['status' => 'verification-link-sent']);
    }
}
