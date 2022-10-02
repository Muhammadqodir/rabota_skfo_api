<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResumeRequest extends FormRequest
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
            'citizenship' => 'required',
            'alt_contact' => '',
            'position' => 'required',
            'salary' => 'required|numeric',
            'salary_by_agreement' => 'required',
            'b_trip' => '',
            'moving' => '',
            'employment_type' => '',
            'education' => '',
            'experience' => '',
            'langs' => '',
            'skills' => '',
            'driver_license' => '',
            'achievements' => '',
            'interests' => '',
            'additional_info' => '',
        ];
    }
}
