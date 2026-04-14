<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobApplicationRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
  public function toArray($request): array
{
    return [
        'id'      => $this->id,
        'status'  => $this->status,
        'message' => $this->message,
        'user'    => new UserResource($this->whenLoaded('user')),
        'job'     => new JobListingResource($this->whenLoaded('jobListing')),
    ];
}
}
