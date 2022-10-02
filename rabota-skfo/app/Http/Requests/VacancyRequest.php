<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacancyRequest extends FormRequest
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
            'vacancy_id' => 'required',
            'position' => 'required',
            'duties' => 'required',
            'conditions' => 'required',
            'salary_from' => 'required',
            'salary_to' => 'required',
            'salary_by_agreement' => 'required',
            'experience' => '',
            'education' => '',
            'sex' => '',
            'tech_knowledges' => '',
            'driver_license' => '',
	    'bonuses' => '',
	    'is_for_dp' => '',
	    'social_package' => '',
            'additional_requirements' => '',
            'additional_info' => '',
            'quize' => '',
            'is_active' => ''
        ];
    }
}
