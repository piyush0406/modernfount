<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
        ];
    }

    private function validationStore(){
        return [
            'author_id'=>'required|valid_author',
            'cover_img'=>'required',
            'title'=>'required',
            'byline'=>'required',
            'place'=>'required',
            
            'content'=>'required',
            'content_img'=>'required',
            
        ];
    }

    private function validationUpdate(){
        return [
            'author_id'=>'required|valid_author',
            'cover_img'=>'required',
            'title'=>'required',
            'byline'=>'required',
            'place'=>'required',
        
            'content'=>'required',
            'content_img'=>'required',
            
        ];
    }

    
}
