<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
public function toArray($request): array
{
    return [
        'id'    => $this->id,
        'name'  => $this->name,
        'email' => $this->email,
        'role'  => $this->role,
        'profile' => $this->when($this->role === 'org',
            new OrganizationProfileResource($this->organizationProfile),
            new SeekerProfileResource($this->seekerProfile),
        ),
    ];
}
}
