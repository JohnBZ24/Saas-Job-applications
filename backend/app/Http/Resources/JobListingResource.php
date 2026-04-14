<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobListingResource extends JsonResource
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
        'title'        => $this->title,
        'description'  => $this->description,
        'location'     => $this->location,
        'type'         => $this->type,
        'salary_range' => $this->salary_range,
        'status'       => $this->status,
        'deadline'     => $this->deadline,
        'organization' => new OrganizationProfileResource($this->whenLoaded('organization')),
        'created_at'   => $this->created_at->toDateString(),
    ];
}

}
