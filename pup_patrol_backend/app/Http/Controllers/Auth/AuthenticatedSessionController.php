<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /** 
 * @OA\post(
 *     path="/login",
 *     tags={"user"},
 *     summary="로그인",
 *     description="로그인",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="email", type="string", description="이메일", example="bapull@member.com" ),
 *                 @OA\Property(property="password", type="string", description="비밀번호", example="password" )
 *             )
 *         )
 *     ),
 *     @OA\Response(response="200", description="로그인이 성공적으로 완료됨")
 * )
 **/
    public function store(LoginRequest $request): Response
    {
        $request->authenticate();

        $request->session()->regenerate();

        return response()->noContent();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
