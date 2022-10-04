<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UniverMore extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'fullName' => $this->fullName,
            'shortName' => $this->shortName,
            'logoUrl' => $this->getUser()->pic,
            'regionId' => $this->getUser()->region_id,
            'studentNumber' => $this->getStudentsCount(),
        ];
    }
}
