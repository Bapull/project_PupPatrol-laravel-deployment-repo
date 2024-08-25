<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
           'postTitle'=>['required','string'],
           'postContent'=>['required','string'],
        ];
    }

    protected function prepareForValidation(){
        $this->merge([
            'post_title'=>$this->postTitle,
            'post_content'=>$this->postContent,
            'post_author'=>$this->user()->email,
        ]);
    }
}
