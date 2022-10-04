<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilePhoto extends FormRequest
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
            'userPic' => 'mimes:jpeg,jpg,png|required|max:20000'
        ];
    }
    
    public function messages()
    {
        return [
            'userPic.mimes' => 'Выберите изображения формата jpeg, jpg, png',
            'userPic.required' => 'Выберите изображения',
            'userPic.max' => 'Выберите изображения размером не более 2 МБ',
        ];
    }
}
