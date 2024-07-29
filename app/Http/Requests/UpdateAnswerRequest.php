<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnswerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->method() == "PUT") {
            return [
                "answerIsBig"=> ["required","boolean"],
                "answerIsFluff"=> ["required","boolean"],
                "answerIsWalking"=> ["required","boolean"],
                "answerIsSmart"=> ["required","boolean"],
                "answerIsShyness"=> ["required","boolean"],
                "answerIsBiting"=> ["required","boolean"],
                "answerIsNuisance"=> ["required","boolean"],
                "answerIsIndependent"=>["required","boolean"],
            ];
        }else{
            return [
                "answerIsBig"=> ["sometimes" ,"required","boolean"],
                "answerIsFluff"=> ["sometimes" ,"required","boolean"],
                "answerIsWalking"=> ["sometimes" ,"required","boolean"],
                "answerIsSmart"=> ["sometimes" ,"required","boolean"],
                "answerIsShyness"=> ["sometimes" ,"required","boolean"],
                "answerIsBiting"=> ["sometimes" ,"required","boolean"],
                "answerIsNuisance"=> ["sometimes" ,"required","boolean"],
                "answerIsIndependent"=>["sometimes" ,"required","boolean"],
            ];
        }
    }
    protected function prepareForValidation(){
        if($this->answerIsBig){
            $this->merge([
                "answer_is_big"=> $this->answerIsBig,
            ]);    
        }
        if($this->answerIsFluff){
            $this->merge([
                "answer_is_fluff"=> $this->answerIsFluff,
            ]);    
        }
        if($this->answerIsWalking){
            $this->merge([
                "answer_is_walking"=>$this->answerIsWalking,
            ]);    
        }
        if($this->answerIsSmart){
            $this->merge([
                "answer_is_smart"=> $this->answerIsSmart,
            ]);    
        }
        if($this->answerIsShyness){
            $this->merge([
                "answer_is_shyness"=> $this->answerIsShyness,
            ]);    
        }
        if($this->answerIsBiting){
            $this->merge([
                "answer_is_biting"=> $this->answerIsBiting,
            ]);    
        }
        if($this->answerIsNuisance){
            $this->merge([
                "answer_is_nuisance"=> $this->answerIsNuisance,
            ]);    
        }
        if($this->answerIsIndependent){
            $this->merge([
                "answer_is_independent"=> $this->answerIsIndependent,
            ]);    
        }
    }
}
