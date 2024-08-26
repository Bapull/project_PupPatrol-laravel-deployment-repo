<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
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
        if($this->method() == 'PUT'){
            return [
                'commentPostId'=>['required','integer'],
                'commentContent'=>['required','string'],
            ];
        }else{
            return [
                'commentPostId'=>["sometimes",'required','integer'],
                'commentContent'=>["sometimes",'required','string'],
            ];
        }
        
    }
    protected function prepareForValidation(){
        
        if($this->commentPostId){
            $this->merge([
                "comment_post_id"=>$this->commentPostId
            ]);
        }
        
        if($this->commentContent){
            $this->merge([
                "comment_content"=>$this->commentContent
            ]);
        }
        
        $this->merge([
            "comment_author"=>$this->user()->email,
        ]);
    }
}
