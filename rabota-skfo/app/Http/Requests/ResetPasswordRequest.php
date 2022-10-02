<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'old_password' => 'required',
            'new_password' => 'required',
            'new_password_retype' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'Поле "Старый пароль" обязательное',
            'new_password.required' => 'Поле "Новый пароль" обязательное',
            'new_password_retype.required' => 'Поле "Новый пароль" обязательное',
        ];
    }
}
