<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentLoginRequest extends FormRequest
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

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'Email',
            'password' => 'Пароль'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Поле Email обязательное',
            'password.required' => 'Поле Пароль обязательное',
            'email.email' => 'Поле Email должен содержать правильный адрес почты'
        ];
    }
}
