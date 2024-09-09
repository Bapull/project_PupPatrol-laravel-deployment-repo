<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionCollection;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;


class QuestionController extends Controller
{
    /** 
 * @OA\get(
 *     path="/api/questions",
 *     tags={"question"},
 *     summary="questions 테이블 조회",
 *     description="questions 테이블의 모든 데이터를 data라는 키를 가진 배열로 반환",
 *      
 *     @OA\Response(response="200", description="success")
 * )
 **/
    public function index()
    {
        //
        
        $questions=  new QuestionCollection(Question::all());
        return response()->json(['data'=>$questions],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        //
    }

    /** 
 * @OA\get(
 *     path="/api/questions/{question}",
 *     tags={"question"},
 *     summary="특정 question 데이터 조회",
 *     description="파라미터로 받은 id를 가지는 question 객체를 data라는 키를 가진 객체로 반환",
 *      @OA\Parameter(
 *          name="question",
 *          description="question의 id",
 *          in="path",
 *          required=true,
 *          example="1",
 *          @OA\Schema(type="json")
 *     ),
 *     @OA\Response(response="200", description="한 개의 question 데이터")
 * )
 **/
    public function show(Question $question)
    {
        //
        return response()->json(['data'=> new QuestionResource(Question::findOrFail($question->id))]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
