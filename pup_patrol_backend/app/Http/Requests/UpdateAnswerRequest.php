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
                "answerIsBig"=> ["required","integer"],
                "answerIsFluff"=> ["required","integer"],
                "answerIsWalking"=> ["required","integer"],
                "answerIsSmart"=> ["required","integer"],
                "answerIsShyness"=> ["required","integer"],
                "answerIsBiting"=> ["required","integer"],
                "answerIsNuisance"=> ["required","integer"],
                "answerIsIndependent"=>["required","integer"],
            ];
        }else{
            return [
                "answerIsBig"=> ["sometimes" ,"required","integer"],
                "answerIsFluff"=> ["sometimes" ,"required","integer"],
                "answerIsWalking"=> ["sometimes" ,"required","integer"],
                "answerIsSmart"=> ["sometimes" ,"required","integer"],
                "answerIsShyness"=> ["sometimes" ,"required","integer"],
                "answerIsBiting"=> ["sometimes" ,"required","integer"],
                "answerIsNuisance"=> ["sometimes" ,"required","integer"],
                "answerIsIndependent"=>["sometimes" ,"required","integer"],
            ];
        }
    }
    protected function prepareForValidation(){
        if($this->answerIsBig){
            $this->merge([
                "answer_is_big"=> $this->answerIsBig == '1' ? 1:0,
            ]);    
        }
        if($this->answerIsFluff){
            $this->merge([
                "answer_is_fluff"=> $this->answerIsFluff == '1' ? 1:0,
            ]);    
        }
        if($this->answerIsWalking){
            $this->merge([
                "answer_is_walking"=> $this->answerIsWalking == '1' ? 1:0,
            ]);    
        }
        if($this->answerIsSmart){
            $this->merge([
                "answer_is_smart"=> $this->answerIsSmart == '1' ? 1:0,
            ]);    
        }
        if($this->answerIsShyness){
            $this->merge([
                "answer_is_shyness"=> $this->answerIsShyness == '1' ? 1:0,
            ]);    
        }
        if($this->answerIsBiting){
            $this->merge([
                "answer_is_biting"=> $this->answerIsBiting == '1' ? 1:0,
            ]);    
        }
        if($this->answerIsNuisance){
            $this->merge([
                "answer_is_nuisance"=> $this->answerIsNuisance == '1' ? 1:0,
            ]);    
        }
        if($this->answerIsIndependent){
            $this->merge([
                "answer_is_independent"=> $this->answerIsIndependent == '1' ? 1:0,
            ]);    
        }
    }
}
