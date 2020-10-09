<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorForm extends FormRequest
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
            //
        ];

    }

    private function validationStore(){
        return [
            'user_id' => 'required|valid_user|unique:users',
            'qualification' => 'string',
            'about' => 'text',
            'expertise' => 'string',
            'fb_link' => 'string',
            'tweet_link' => 'string',
            'insta_link' => 'string'
            
        ];
    }
    private function validationUpdate(){
        return [
            'user_id' => 'required|valid_user|unique:users',
            'qualification' => 'string',
            'about' => 'text',
            'expertise' => 'string',
            'fb_link' => 'string',
            'tweet_link' => 'string',
            'insta_link' => 'string'
            
        ];
    }
}
