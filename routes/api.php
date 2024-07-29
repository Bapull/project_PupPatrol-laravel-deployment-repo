<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\InformationController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::get('refresh', [AuthController::class, 'refresh']);
Route::middleware('auth:api')->get('me', [AuthController::class, 'me']);

Route::get('answers',[AnswerController::class, 'index']);
Route::get('informations', [InformationController::class, 'index']);
Route::get('questions', [QuestionController::class, 'index']);
Route::get('answers/{answer}',[AnswerController::class, 'show']);
Route::get('informations/{information}', [InformationController::class, 'show']);

Route::middleware('auth:api')->post('answers',[AnswerController::class, 'store']);
Route::middleware('auth:api')->post('informations', [InformationController::class, 'store']);

Route::middleware('auth:api')->put('answers/{answer}',[AnswerController::class,'update']);
Route::middleware('auth:api')->put('informations/{information}',[InformationController::class,'update']);

Route::middleware('auth:api')->patch('answers/{answer}',[AnswerController::class,'update']);
Route::middleware('auth:api')->patch('informations/{information}',[InformationController::class,'update']);

Route::middleware('auth:api')->delete('answers/{answer}',[AnswerController::class, 'destroy']);
Route::middleware('auth:api')->delete('informations/{information}', [InformationController::class, 'destroy']);