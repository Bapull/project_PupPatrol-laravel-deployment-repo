<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDogRequest extends FormRequest
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
            'dogName'=> ["required","string"],
            'dogBreed'=> ["required","string"],
            'dogBirthDate'=> ["required","date"],
            'dogPhotoName'=> ["required","string"],
        ];
    }
    protected function prepareForValidation(){
        $this->merge([
            'dog_name'=>$this->dogName,
            'dog_breed'=>$this->dogBreed,
            'dog_birth_date'=>$this->dogBirthDate,
            'dog_owner_email'=>$this->user()->email,
            'dog_photo_name'=>$this->dogPhotoName,
        ]);
    }
}
