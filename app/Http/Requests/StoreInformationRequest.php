<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInformationRequest extends FormRequest
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
    }
    protected function prepareForValidation(){
        $this->merge([
            'information_dog_name'=>$this->informationDogName,
            'information_dog_character'=>$this->informationDogCharacter,
            'information_min_size'=>$this->informationMinSize,
            'information_max_size'=>$this->informationMaxSize,
            'information_min_cost'=>$this->informationMinCost,
            'information_max_cost'=>$this->informationMaxCost,
            'information_dog_text'=>$this->informationDogText,
            'information_dog_geneticillness'=>$this->informationDogGeneticillness,
            'information_caution'=>$this->informationCaution,
            'information_image_url'=> $this->informationImageUrl,
        ]);
    }
}
