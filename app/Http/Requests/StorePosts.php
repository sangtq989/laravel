<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePosts extends FormRequest
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

            'titlePost' => 'required|max:100',
            'sapoPost'=>'required|max:100',
            'avatarPost'=>'required|mimes:jpeg,bmp,png,jpg,gif',
            'language'=>'required|numeric',
            'categories'=>'required|numeric',
            'contentPost'=>'required',

            //
        ];
    }
    //message error
    public function messages()
    {
       return [

            'titlePost.required'=>':attribute khong duoc trong',
            'titlePost.max' => ':attribute khong lon hon :max ki tu',
            'sapoPost.required' => ':attribute khong duoc trong',
            'sapoPost.max' => ':attribute khong lon hon :max ki tu',
            'avatarPost.required' => 'moi chon anh',
            'avatarPost.mimes' => ' anh chi ho tro jpeg,bmp,png,jpg,gif, anh cua ban la dinh dang :mimes ',
            'language.required' => ':attribute khong duoc trong',
            'language.numeric' => 'Vui long chon ngon ngu',
            'categories.required' => ':attribute khong duoc trong',
            'categories.numeric' => 'categories khong dung',
            'contentPost.required'=>':attribute khong duoc trong',
            
       ];
    }
}
