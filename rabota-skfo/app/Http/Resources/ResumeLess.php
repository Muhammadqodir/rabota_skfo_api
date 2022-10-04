<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResumeLess extends JsonResource
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
                'position' => $this->position,
                'fullName' => $this->getUser()->name
            ];
        }

        return [
            'id' => $this->id,
            'position' => $this->position,
            'fullName' => "undefined"
        ];
    }
}
