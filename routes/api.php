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

Route::middleware('auth:api')->group(function () {
    Route::post('answers',[AnswerController::class, 'store']);
    Route::post('informations', [InformationController::class, 'store']);
    
    Route::put('answers/{answer}',[AnswerController::class,'update']);
    Route::put('informations/{information}',[InformationController::class,'update']);
    
    Route::patch('answers/{answer}',[AnswerController::class,'update']);
    Route::patch('informations/{information}',[InformationController::class,'update']);
    
    Route::delete('answers/{answer}',[AnswerController::class, 'destroy']);
    Route::delete('informations/{information}', [InformationController::class, 'destroy']);
    
});

