<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
                'postTitle'=>['required','string'],
                'postContent'=>['required','string'],
             ];
        }else{
            return [
                'postTitle'=>['sometimes','required','string'],
                'postContent'=>['sometimes','required','string'],
             ];
        }
        
    }
    protected function prepareForValidation(){
        
        if($this->postTitle){
            $this->merge([
                'post_title'=> $this->postTitle
            ]);
        }
        if($this->postContent){
            $this->merge([
                'post_content'=> $this->postContent
            ]);
        }
        $this->merge(['post_author'=>$this->user()->email]);
        
    }
}
