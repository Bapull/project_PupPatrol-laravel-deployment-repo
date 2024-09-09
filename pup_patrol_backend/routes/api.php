<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserUpdateController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth:sanctum'])->patch('/user-update', [UserUpdateController::class, 'update']);

Route::get('answers',[AnswerController::class, 'index']);
Route::get('informations', [InformationController::class, 'index']);
Route::get('questions', [QuestionController::class, 'index']);
Route::get('answers/{answer}',[AnswerController::class, 'show']);
Route::get('informations/{information}', [InformationController::class, 'show']);

Route::get('/imageDownload',[ImageController::class,'download']);
Route::post('/imageUpload',[ImageController::class,'upload']);
Route::delete('/imageDelete',[ImageController::class,'destroy']);


Route::apiResource('/dogs',DogController::class);
Route::apiResource('posts',PostController::class);

Route::get('/comments/{postId}',[CommentController::class, 'index']);
Route::put('/comments/{comment}',[CommentController::class,'update']);
Route::post('/comments',[CommentController::class,'store']);
Route::patch('/comments/{comment}',[CommentController::class,'update']);
Route::delete('/comments/{comment}',[CommentController::class, 'destroy']);

Route::middleware('auth:sanctum')->middleware([IsAdmin::class])->group(function () {
    Route::post('answers',[AnswerController::class, 'store']);
    Route::post('informations', [InformationController::class, 'store']);
    
    Route::put('answers/{answer}',[AnswerController::class,'update']);
    Route::put('informations/{information}',[InformationController::class,'update']);
    
    Route::patch('answers/{answer}',[AnswerController::class,'update']);
    Route::patch('informations/{information}',[InformationController::class,'update']);
    
    Route::delete('answers/{answer}',[AnswerController::class, 'destroy']);
    Route::delete('informations/{information}', [InformationController::class, 'destroy']);
    
    
    
    
});



