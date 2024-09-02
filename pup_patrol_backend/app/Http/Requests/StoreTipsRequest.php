<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTipsRequest extends FormRequest
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
           'tipsTitle'=>['required','string'],
           'tipsText'=>['required','string'],
        ];
    }

    protected function prepareForValidation(){
        $this->merge([
            'tips_title'=>$this->tipsTitle,
            'tips_text'=>$this->postText,
        ]);
    }
}
