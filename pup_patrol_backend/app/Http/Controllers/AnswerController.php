<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnswerCollection;
use App\Http\Resources\AnswerResource;
use App\Models\Answer;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;

/**
 * @OA\Info(title="pup_patrol", version="1")
 **/
class AnswerController extends Controller
{
     /** 
 * @OA\get(
 *     path="/api/answers",
 *     tags={"answer"},
 *     summary="answers 테이블",
 *     description="answers 테이블에 등록된 모든 데이터를 data라는 키를 가진 배열로 반환",
 *      
 *     @OA\Response(response="200", description="success")
 * )
 **/
    public function index()
    {
        
        //
        $answers = new AnswerCollection(Answer::all());
        return response()->json(['data'=> $answers],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

     /** 
 * @OA\post(
 *     path="/api/answers",
 *     tags={"answer"},
 *     summary="answers 테이블에 데이터 추가",
 *     description="answers 테이블에 데이터를 추가함",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="answerIsBig", type="boolean", description="대형견 인지 아닌지", example=" 1 or 5 (1:True,  1이 아닌 모든 숫자:False, 0은 인식 못 함)" ),
 *                 @OA\Property(property="answerIsFluff", type="boolean", description="장묘종인지 아닌지", example=" 1 or 5 " ),
 *                 @OA\Property(property="answerIsWalking", type="boolean", description="운동이 많이 필요한지 아닌지", example=" 1 or 5 " ),
 *                 @OA\Property(property="answerIsSmart", type="boolean", description="지능이 높은 편인지 아닌지", example=" 1 or 5 " ),
 *                 @OA\Property(property="answerIsShyness", type="boolean", description="낯가림이 심한지 아닌지", example=" 1 or 5 " ),
 *                 @OA\Property(property="answerIsBiting", type="boolean", description="입질이 심한지 아닌지", example=" 1 or 5 " ),
 *                 @OA\Property(property="answerIsNuisance", type="boolean", description="치명적인 유전병이 있는지 아닌지", example=" 1 or 5 " ),
 *                 @OA\Property(property="answerIsIndependent", type="boolean", description="독립심이 있는지 아닌지", example=" 1 or 5 " )
 * 
 *             )
 *         )
 *     ),
 *     @OA\Response(response="201", description="answer이 성공적으로 추가됨")
 * )
 **/
    public function store(StoreAnswerRequest $request)
    {
        //
        
        $answer = new AnswerResource(Answer::create($request->all()));
        return response()->json(['data'=> $answer],201);
    }


     /** 
 * @OA\get(
 *     path="/api/answers/{answer}",
 *     tags={"answer"},
 *     summary="파라미터로 넘어온 id를 가지는 특정 answer 데이터 조회",
 *     description="파라미터로 넘어온 id를 가지는 특정 answer 데이터를 data라는 키를 가진 객체로 반환",
 *      @OA\Parameter(
 *          name="answer",
 *          description="answer의 id",
 *          in="path",
 *          required=true,
 *          example="1",
 *          @OA\Schema(type="json")
 *     ),
 *     @OA\Response(response="200", description="한 강아지의 answer 데이터")
 * )
 **/
    public function show(Answer $answer)
    {
        //
        return response()->json(['data'=> new AnswerResource(Answer::findOrFail($answer->id))],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        //
    }

     /** 
 * @OA\put(
 *     path="/api/answers/{answer}",
 *     tags={"answer"},
 *     summary="answer데이터 수정",
 *     description="한 개의 answer데이터를 수정함 ",
 *     @OA\Parameter(
 *          name="answer",
 *          description="answer의 아이디",
 *          in="path",
 *          required=true,
 *          example="1",
 *          @OA\Schema(type="string")
 *     ),
 *      @OA\RequestBody(
 *          @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *              @OA\Property(property="answerIsBig", type="boolean", description="대형견 인지 아닌지", example=" 1 or 5 (1:True,  1이 아닌 모든 숫자:False, 0은 인식 못 함)" ),
 *              @OA\Property(property="answerIsFluff", type="boolean", description="장묘종인지 아닌지", example=" 1 or 5 " ), 
 *              @OA\Property(property="answerIsWalking", type="boolean", description="운동이 많이 필요한지 아닌지", example=" 1 or 5 " ),
 *              @OA\Property(property="answerIsSmart", type="boolean", description="지능이 높은 편인지 아닌지", example=" 1 or 5 " ),
 *              @OA\Property(property="answerIsShyness", type="boolean", description="낯가림이 심한지 아닌지", example=" 1 or 5 " ),
 *              @OA\Property(property="answerIsBiting", type="boolean", description="입질이 심한지 아닌지", example=" 1 or 5 " ),
 *              @OA\Property(property="answerIsNuisance", type="boolean", description="치명적인 유전병이 있는지 아닌지", example=" 1 or 5 " ),
 *              @OA\Property(property="answerIsIndependent", type="boolean", description="독립심이 있는지 아닌지", example=" 1 or 5 " )
 *          )
 *      )
 * ),
 *     @OA\Response(response="200", description="수정이 된 경우")
 * )
 **/
    public function update(UpdateAnswerRequest $request, Answer $answer)
    {
        //
        return response()->json(['data'=> $answer->update($request->all())],200);
    }

    /** 
 * @OA\delete(
 *     path="/api/answers/{answer}",
 *     tags={"answer"},
 *     summary="특정 answer 데이터 삭제",
 *     description="하나의 answer을 삭제함",
 *      @OA\Parameter(
 *          name="answer",
 *          description="강아지의 id",
 *          in="path",
 *          required=true,
 *          example="1",
 *          @OA\Schema(type="json")
 *     ),
 *     @OA\Response(response="200", description="answer 삭제에 성공한 경우")
 * )
 **/
    public function destroy(Answer $answer)
    {
        //
        return response()->json(['data'=> $answer->delete()],200);
    }
}
