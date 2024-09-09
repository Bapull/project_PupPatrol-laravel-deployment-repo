<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
     /** 
 * @OA\post(
 *     path="/register",
 *     tags={"user"},
 *     summary="회원가입",
 *     description="회원가입",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="email", type="string", description="이메일", example="bapull@member.com" ),
 *                 @OA\Property(property="password", type="string", description="비밀번호", example="password" ),
 *                 @OA\Property(property="name", type="string", description="닉네임", example="z지존w어둠z" ),
 *                 @OA\Property(property="profilePicture", type="string", description="api/imageUpload 프로필 사진 파일명", example="password" ),
 *                 @OA\Property(property="birthday", type="date", description="생일", example="2024-09-09" )
 *             )
 *         )
 *     ),
 *     @OA\Response(response="200", description="회원가입이 성공적으로 완료됨")
 * )
 **/
    public function store(Request $request): Response
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'profilePicture' => ['required', 'string'],
            'birthday' => ['required', 'date']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
            'profile_picture' => $request->profilePicture,
            'birthday' => $request-> birthday
        ]);

        event(new Registered($user));

        Auth::login($user);

        return response()->noContent();
    }
}
