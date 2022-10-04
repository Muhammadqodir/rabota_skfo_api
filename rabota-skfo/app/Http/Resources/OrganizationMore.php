<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationMore extends JsonResource
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
            'organization' => $this->name,
            'form' => $this->form,
            'logoUrl' => $this->getUser()->pic,
            'webSite' => $this->web_site,
            'description' => $this->description,
            'sphere' => $this->sphere,
            'vacanciesNumber' => $this->getVacanciesCount()
        ];
    }
}
