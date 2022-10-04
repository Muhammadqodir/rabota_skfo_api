<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrgProfileUpadateRequest extends FormRequest
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
            'phoneNumber' => 'required|min:12',
            'orgForm' => 'required',
            'orgName' => 'required',
            'description' => 'required',
            'description' => 'required',
            'website' => '',
            'orgSphere' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'fullName' => 'Ф.И.О',
            'phoneNumber' => 'Номер телефона',
            'orgForm' => 'Форма организации',
            'orgName' => 'Название организации',
            'orgSphere' => 'Сфера деятельности',
        ];
    }

    public function messages()
    {
        return [
            'fullName.required' => 'Поле Ф.И.О обязательное',
            'fullName.max' => 'Поле Ф.И.О должен содержать максимум 255 символов',
            'fullName.min' => 'Поле Ф.И.О должен содержать минимум 5 символов',
            'phoneNumber.required' => 'Поле Номер телефона обязательное',
            'phoneNumber.min' => 'Неверный формат номера телефона',
            'orgForm.required' => 'Поле Форма организации обязательное',
            'region.required' => 'Поле Регион обязательное',
            'orgSphere.required' => 'Поле Сфера деятельности обязательное',
            'orgName.required' => 'Поле Название организации обязательное',
            'description.required' => 'Поле Описание организации обязательное',
            'region.digits' => 'Регион не найден',
        ];
    }
}
