<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
  public function toArray($request): array
{
    return [
        'id'           => $this->id,
        'company_name' => $this->company_name,
        'description'  => $this->description,
        'website'      => $this->website,
        'industry'     => $this->industry,
        'phone'        => $this->phone,
        'email'        => $this->email,
        'country'      => $this->country,
        'city'         => $this->city,
        'address'      => $this->address,
        'plan'         => $this->plan,
    ];
}
}
