<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRegisterRequest extends FormRequest
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
            'email' => 'required|email',
            'region' => 'required|digits:1',
            'fullName' => 'required|min:5|max:255',
            'phoneNumber' => 'required|min:12',
            'orgForm' => 'required',
            'orgName' => 'required',
            'orgSphere' => 'required',
            'password' => 'required|min:8|max:255'
        ];
    }

    public function attributes()
    {
        return [
            'fullName' => 'Ф.И.О',
            'email' => 'Email',
            'phoneNumber' => 'Номер телефона',
            'orgForm' => 'Форма организации',
            'orgName' => 'Название организации',
            'orgSphere' => 'Сфера деятельности',
            'password' => 'Пароль'
        ];
    }

    public function messages()
    {
        return [
            'fullName.required' => 'Поле Ф.И.О обязательное',
            'fullName.max' => 'Поле Ф.И.О должен содержать максимум 255 символов',
            'fullName.min' => 'Поле Ф.И.О должен содержать минимум 5 символов',
            'email.required' => 'Поле Email обязательное',
            'email.email' => 'Поле Email должен содержать правильный адрес почты',
            'phoneNumber.required' => 'Поле Номер телефона обязательное',
            'phoneNumber.min' => 'Неверный формат номера телефона',
            'password.required' => 'Поле Пароль обязательное',
            'password.max' => 'Поле Пароль должен содержать максимум 255 символов',
            'password.min' => 'Поле Пароль должен содержать минимум 8 символов',
            'orgForm.required' => 'Поле Форма организации обязательное',
            'region.required' => 'Поле Регион обязательное',
            'orgSphere.required' => 'Поле Сфера деятельности обязательное',
            'orgName.required' => 'Поле Название организации обязательное',
            'region.digits' => 'Регион не найден',
        ];
    }
}
