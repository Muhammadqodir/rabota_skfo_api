<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentMore extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->getUser() != null){
            return [
                'id' => $this->id,
                'fullName' => $this->getUser()->name,
                'userPic' => $this->getUser()->pic,
                'regionId' => $this->getUser()->region_id,
                'universityId' => $this->university_id,
                'sex' => $this->sex,
                'birthDay' => $this->bday,
                'course' => $this->course,
                'speciality' => $this->speciality,
                'degree' => $this->degree
            ];
        }
        return [
            'id' => $this->id,
            'fullName' => "undefined",
            'userPic' => "undefined",
            'regionId' => "undefined",
            'universityId' => $this->university_id,
            'sex' => $this->sex,
            'birthDay' => $this->bday,
            'course' => $this->course,
            'speciality' => $this->speciality,
            'degree' => $this->degree
        ];
    }
}
