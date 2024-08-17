<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DogResource extends JsonResource
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
            'dogName'=>$this->dog_name,
            'dogBreed'=>$this->dog_breed,
            'dogBirthDate'=>$this->dog_birth_date,
            'dogOwnerEmail'=>$this->dog_owner_email,
            'dogPhotoUrl'=>$this->dog_photo_url,
        ];
    }
}
