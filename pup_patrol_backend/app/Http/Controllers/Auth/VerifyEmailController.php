<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /** 
 * @OA\get(
 *     path="/sanctum/csrf-cookie",
 *     tags={"user"},
 *     summary="csrf 토큰을 발급함",
 *     description="이 경로로 요청을 보내서 csrf 쿠키를 받은 후, httpOnly 쿠키로 저장하면 됨",
 *      
 *     @OA\Response(response="204", description="success")
 * )
 **/
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // 이 컨트롤러가 csrf 쿠키를 발행하는건 아니지만 문서화를 위해 안 쓰는 컨트롤러에
        // 위 어노테이션을 달았음
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(
                config('app.frontend_url').'/dashboard?verified=1'
            );
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(
            config('app.frontend_url').'/dashboard?verified=1'
        );
    }
}
