<?php

namespace App\Http\Requests;

use App\Models\Dog;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $dog = Dog::findOrFail($this->id);
        if($this->user()->email == $dog->dog_owner_email){
            return true;
        }else{
            return false;
        }
        
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
                'dogName'=> ["required","string"],
                'dogBreed'=> ["required","string"],
                'dogBirthDate'=> ["required","date"],
                'dogPhotoUrl'=> ["required","string"],
            ];
        }else{
            return [
                'dogName'=> ["sometimes" ,"required","string"],
                'dogBreed'=> ["sometimes" ,"required","string"],
                'dogBirthDate'=> ["sometimes" ,"required","date"],
                'dogPhotoUrl'=> ["sometimes" ,"required","string"],
            ];
        }
    }
    protected function prepareForValidation(){
        if($this->dogName){
            $this->merge([
                'dog_name'=>$this->dogName
            ]);
        }
        if($this->dogBreed){
            $this->merge([
                'dog_breed'=>$this->dogBreed
            ]);
        }
        if($this->dogBirthDate){
            $this->merge([
                'dog_birth_date'=>$this->dogBirthDate
            ]);
        }
        
        if($this->dogPhotoUrl){
            $this->merge([
                'dog_photo_url'=>$this->dogPhotoUrl
            ]);
        }

        
        $this->merge([
            'dog_owner_email'=>$this->user()->email
        ]);
        
    }
}
