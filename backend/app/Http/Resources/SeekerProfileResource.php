<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeekerProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
 public function toArray($request): array
{
    return [
        'id'             => $this->id,
        'first_name'     => $this->first_name,
        'last_name'      => $this->last_name,
        'headline'       => $this->headline,
        'bio'            => $this->bio,
        'phone'          => $this->phone,
        'country'        => $this->country,
        'city'           => $this->city,
        'open_to_remote' => $this->open_to_remote,
        'available'      => $this->available,
    ];
}
}
