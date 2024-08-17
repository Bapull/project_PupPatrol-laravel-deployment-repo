<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\QuestionController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('answers',[AnswerController::class, 'index']);
Route::get('informations', [InformationController::class, 'index']);
Route::get('questions', [QuestionController::class, 'index']);
Route::get('answers/{answer}',[AnswerController::class, 'show']);
Route::get('informations/{information}', [InformationController::class, 'show']);

Route::get('/imageDownload',[ImageController::class,'download']);
Route::post('/imageUpload',[ImageController::class,'upload']);
Route::delete('/imageDelete',[ImageController::class,'destroy']);


Route::apiResource('dogs',DogController::class);


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



