<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InformationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'informationDogName'=>$this->information_dog_name,
            'informationDogCharacter'=>$this->information_dog_character,
            'informationMinSize'=>$this->information_min_size,
            'informationMaxSize'=>$this->information_max_size,
            'informationMinCost'=>$this->information_min_cost,
            'informationMaxCost'=>$this->information_max_cost,
            'informationDogText'=>$this->information_dog_text,
            'informationDogGeneticillness'=>$this->information_dog_geneticillness,
            'informationCaution'=>$this->information_caution,
            'informationImageName'=> $this->information_image_name
        ];
    }
}
