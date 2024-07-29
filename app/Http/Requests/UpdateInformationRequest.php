<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInformationRequest extends FormRequest
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
        if($this->method() == "PUT"){
            return [
                'informationDogName'=>["required","string"],
                'informationDogCharacter'=>["required","string"],
                'informationMinSize'=>["required","integer"],
                'informationMaxSize'=>["required","integer"],
                'informationMinCost'=>["required","integer"],
                'informationMaxCost'=>["required","integer"],
                'informationDogText'=>["required","string"],
                'informationDogGeneticillness'=>["required","string"],
                'informationCaution'=>["required","string"],
                'informationImageUrl'=>["required","string"]
            ];
           }else{
            return [
                'informationDogName'=>[ "sometimes" ,"required","string"],
                'informationDogCharacter'=>[ "sometimes" ,"required","string"],
                'informationMinSize'=>[ "sometimes" ,"required","integer"],
                'informationMaxSize'=>[ "sometimes" ,"required","integer"],
                'informationMinCost'=>[ "sometimes" ,"required","integer"],
                'informationMaxCost'=>[ "sometimes" ,"required","integer"],
                'informationDogText'=>[ "sometimes" ,"required","string"],
                'informationDogGeneticillness'=>[ "sometimes" ,"required","string"],
                'informationCaution'=>[ "sometimes" ,"required","string"],
                'informationImageUrl'=>[ "sometimes" ,"required","string"]
            ];
           }
    }
    protected function prepareForValidation(){
        if($this->informationDogName){
            $this->merge([
                'information_dog_name'=>$this->informationDogName
            ]);
        }
        if($this->informationDogCharacter){
            $this->merge([
                'information_dog_character'=>$this->informationDogCharacter,
            ]);
        }
        if($this->informationMinSize){
            $this->merge([
                'information_min_size'=>$this->informationMinSize,
            ]);
        }
        if($this->informationMaxSize){
            $this->merge([
                'information_max_size'=>$this->informationMaxSize,
            ]);
        }
        if($this->informationMinCost){
            $this->merge([
                'information_min_cost'=>$this->informationMinCost,
            ]);
        }
        if($this->informationMaxCost){
            $this->merge([
                'information_max_cost'=>$this->informationMaxCost,
            ]);
        }
        if($this->informationDogText){
            $this->merge([
                'information_dog_text'=>$this->informationDogText,
            ]);
        }
        if($this->informationDogGeneticillness){
            $this->merge([
                'information_dog_geneticillness'=>$this->informationDogGeneticillness,
            ]);
        }
        if($this->informationCaution){
            $this->merge([
                'information_caution'=>$this->informationCaution,
            ]);
        }
        if($this->informationImageUrl){
            $this->merge([
                'information_image_url'=> $this->informationImageUrl,
            ]);
        }
    }
}
