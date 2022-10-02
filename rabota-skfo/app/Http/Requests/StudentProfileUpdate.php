<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentProfileUpdate extends FormRequest
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
            'region' => 'required|digits:1',
            'fullName' => 'required|min:5|max:255',
            'userPic' => 'mimes:jpeg,jpg,png|max:3000',
            'phoneNumber' => 'required|min:12',
            'burnDate' => 'required|date'
        ];
    }

    public function attributes()
    {
        return [
            'fullName' => 'Ф.И.О',
            'email' => 'Email',
            'phoneNumber' => 'Номер телефона',
            'burnDate' => 'Дата рождения',
            'password' => 'Пароль'
        ];
    }

    public function messages()
    {
        return [
            'userPic.mimes' => 'Доступны только файлы с расширением jpeg, jpg, png',
            'userPic.max' => 'Размер файла должна быть не более 3МБ',
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
            'burnDate.required' => 'Поле Дата рождения обязательное',
            'burnDate.date' => 'Неверный формат даты',
            'region.required' => 'Поле Регион обязательное',
            'region.digits' => 'Регион не найден',
        ];
    }
}
