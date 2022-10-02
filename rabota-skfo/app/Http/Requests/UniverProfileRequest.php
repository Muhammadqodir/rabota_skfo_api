<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UniverProfileRequest extends FormRequest
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
            'shortName' => 'required|min:1|max:255',
            'userPic' => 'mimes:jpeg,jpg,png|max:3000',
            'phoneNumber' => ''
        ];
    }
}
