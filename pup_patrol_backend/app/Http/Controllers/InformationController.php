<?php

namespace App\Http\Controllers;

use App\Http\Resources\InformationCollection;
use App\Http\Resources\InformationResource;
use App\Models\Information;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInformationRequest;
use App\Http\Requests\UpdateInformationRequest;

class InformationController extends Controller
{
    /** 
 * @OA\get(
 *     path="/api/informations",
 *     tags={"information"},
 *     summary="informations 테이블",
 *     description="informations 테이블에 등록된 모든 데이터를 data라는 키를 가진 배열로 반환",
 *      
 *     @OA\Response(response="200", description="success")
 * )
 **/
    public function index()
    {
        //
        
        $information = new InformationCollection(Information::all());
        return response()->json(['data'=>$information],200);
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
 *     path="/api/informations",
 *     tags={"information"},
 *     summary="informations 테이블에 데이터 추가",
 *     description="(admin 계정만 가능) informations 테이블에 데이터를 추가함",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="informationDogName", type="string", description="강아지 이름", example="골든 리트리버" ),
 *                 @OA\Property(property="informationDogCharacter", type="string", description="강아지 성격", example="온화하고 영리함" ),
 *                 @OA\Property(property="informationMinSize", type="int", description="평균 사이즈 범위의 시작 값", example="56" ),
 *                 @OA\Property(property="informationMaxSize", type="int", description="평균 사이즈 범위의 끝 값", example="61" ),
 *                 @OA\Property(property="informationMinCost", type="int", description="평균 분양가 범위의 시작 값", example="25" ),
 *                 @OA\Property(property="informationMaxCost", type="int", description="평균 분양가 범위의 끝 값 ", example="80" ),
 *                 @OA\Property(property="informationDogText", type="string", description="강아지 설명", example="골든 리트리버는 온화하며 특히 순종적이고 영리합니다. 사람에게 부드럽고 우호적입니다." ),
 *                 @OA\Property(property="informationDogGeneticillness", type="string", description="유전병 정보", example="고관절 이형성증, 백내장, 암" ),
 *                 @OA\Property(property="informationCaution", type="string", description="주의사항", example="사람에게는 착하지만, 다른 개들에게는 사나울 수 있습니다." ),
 *                 @OA\Property(property="informationImageName", type="string", description="이미지 파일 이름", example="Golden Retriever.png" )
 *             )
 *         )
 *     ),
 *     @OA\Response(response="201", description="information이 성공적으로 추가됨"),
 *     @OA\Response(response="401", description="관리자 계정이 아닌 경우")
 * )
 **/
    public function store(StoreInformationRequest $request)
    {
        //
        $information = new InformationResource(Information::create($request->all()));
        return response()->json(['data'=>$information],201);
    }

    /** 
 * @OA\get(
 *     path="/api/informations/{information}",
 *     tags={"information"},
 *     summary="파라미터로 넘어온 id를 가지는 특정 information 데이터 조회",
 *     description="파라미터로 넘어온 id를 가지는 특정 information 데이터를 data라는 키를 가진 객체로 반환",
 *      @OA\Parameter(
 *          name="information",
 *          description="information의 id",
 *          in="path",
 *          required=true,
 *          example="1",
 *          @OA\Schema(type="json")
 *     ),
 *     @OA\Response(response="200", description="한 강아지의 information 데이터")
 * )
 **/
    public function show(Information $information)
    {
        //
        return response()->json(['data'=>new InformationResource(Information::findOrFail($information->id))],200);
    }

    /** 
 * @OA\patch(
 *     path="/api/informations/{information}",
 *     tags={"information"},
 *     summary="information데이터 수정",
 *     description="(admin 계정만 가능) 한 개의 information데이터를 수정함 ",
 *     @OA\Parameter(
 *          name="information",
 *          description="information의 아이디",
 *          in="path",
 *          required=true,
 *          example="1",
 *          @OA\Schema(type="string")
 *     ),
 *      @OA\RequestBody(
 *          @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *                @OA\Property(property="informationDogName", type="string", description="강아지 이름", example="골든 리트리버" ),
 *                 @OA\Property(property="informationDogCharacter", type="string", description="강아지 성격", example="온화하고 영리함" ),
 *                 @OA\Property(property="informationMinSize", type="int", description="평균 사이즈 범위의 시작 값", example="56" ),
 *                 @OA\Property(property="informationMaxSize", type="int", description="평균 사이즈 범위의 끝 값", example="61" ),
 *                 @OA\Property(property="informationMinCost", type="int", description="평균 분양가 범위의 시작 값", example="25" ),
 *                 @OA\Property(property="informationMaxCost", type="int", description="평균 분양가 범위의 끝 값 ", example="80" ),
 *                 @OA\Property(property="informationDogText", type="string", description="강아지 설명", example="골든 리트리버는 온화하며 특히 순종적이고 영리합니다. 사람에게 부드럽고 우호적입니다." ),
 *                 @OA\Property(property="informationDogGeneticillness", type="string", description="유전병 정보", example="고관절 이형성증, 백내장, 암" ),
 *                 @OA\Property(property="informationCaution", type="string", description="주의사항", example="사람에게는 착하지만, 다른 개들에게는 사나울 수 있습니다." ),
 *                 @OA\Property(property="informationImageName", type="string", description="이미지 파일 이름", example="Golden Retriever.png")
 *          )
 *      )
 * ),
 *     @OA\Response(response="200", description="수정이 된 경우"),
 *     @OA\Response(response="401", description="관리자 계정이 아닌 경우")
 * )
 **/
    public function edit(Information $information)
    {
        //
    }

    /** 
 * @OA\put(
 *     path="/api/informations/{information}",
 *     tags={"information"},
 *     summary="information데이터 수정",
 *     description="(admin 계정만 가능) 한 개의 information데이터를 수정함 ",
 *     @OA\Parameter(
 *          name="information",
 *          description="information의 아이디",
 *          in="path",
 *          required=true,
 *          example="1",
 *          @OA\Schema(type="string")
 *     ),
 *      @OA\RequestBody(
 *          @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *                @OA\Property(property="informationDogName", type="string", description="강아지 이름", example="골든 리트리버" ),
 *                 @OA\Property(property="informationDogCharacter", type="string", description="강아지 성격", example="온화하고 영리함" ),
 *                 @OA\Property(property="informationMinSize", type="int", description="평균 사이즈 범위의 시작 값", example="56" ),
 *                 @OA\Property(property="informationMaxSize", type="int", description="평균 사이즈 범위의 끝 값", example="61" ),
 *                 @OA\Property(property="informationMinCost", type="int", description="평균 분양가 범위의 시작 값", example="25" ),
 *                 @OA\Property(property="informationMaxCost", type="int", description="평균 분양가 범위의 끝 값 ", example="80" ),
 *                 @OA\Property(property="informationDogText", type="string", description="강아지 설명", example="골든 리트리버는 온화하며 특히 순종적이고 영리합니다. 사람에게 부드럽고 우호적입니다." ),
 *                 @OA\Property(property="informationDogGeneticillness", type="string", description="유전병 정보", example="고관절 이형성증, 백내장, 암" ),
 *                 @OA\Property(property="informationCaution", type="string", description="주의사항", example="사람에게는 착하지만, 다른 개들에게는 사나울 수 있습니다." ),
 *                 @OA\Property(property="informationImageName", type="string", description="이미지 파일 이름", example="Golden Retriever.png")
 *          )
 *      )
 * ),
 *     @OA\Response(response="200", description="수정이 된 경우"),
 *     @OA\Response(response="401", description="관리자 계정이 아닌 경우")
 * )
 **/
    public function update(UpdateInformationRequest $request, Information $information)
    {
        //
        return response()->json(['data'=>$information->update($request->all())],200);
    }

    /** 
 * @OA\delete(
 *     path="/api/informations/{information}",
 *     tags={"information"},
 *     summary="특정 information 데이터 삭제",
 *     description="하나의 information을 삭제함",
 *      @OA\Parameter(
 *          name="information",
 *          description="강아지의 id",
 *          in="path",
 *          required=true,
 *          example="1",
 *          @OA\Schema(type="json")
 *     ),
 *     @OA\Response(response="200", description="information 삭제에 성공한 경우"),
 *     @OA\Response(response="401", description="관리자 계정이 아닌 경우")
 * )
 **/
    public function destroy(Information $information)
    {
        //
        return response()->json(['data'=>$information->delete()],200);
    }
}
