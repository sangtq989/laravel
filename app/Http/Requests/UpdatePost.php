<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePost extends FormRequest
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
            'language'=>'required|numeric',
            'categories'=>'required|numeric',
            'contentPost'=>'required',
        ];
    }
    public function messages()
    {
       return [

            'titlePost.required'=>':attribute khong duoc trong',
            'titlePost.max' => ':attribute khong lon hon :max ki tu',
            'sapoPost.required' => ':attribute khong duoc trong',
            'sapoPost.max' => ':attribute khong lon hon :max ki tu',
            'language.required' => ':attribute khong duoc trong',
            'language.numeric' => 'Vui long chon ngon ngu',
            'categories.required' => ':attribute khong duoc trong',
            'categories.numeric' => 'categories khong dung',
            'contentPost.required'=>':attribute khong duoc trong',
            
       ];
    }
}
