<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOrganizationProfileRequest;
use App\Http\Resources\OrganizationProfileResource;
use Illuminate\Http\Request;

class OrganizationProfileController extends Controller
{
    public function show(Request $request)
    {
        $profile = $request->user()->organizationProfile;

        return new OrganizationProfileResource($profile);
    }

    public function update(UpdateOrganizationProfileRequest $request)
    {
        $profile = $request->user()->organizationProfile;

        $profile->update($request->validated());

        return new OrganizationProfileResource($profile);
    }
}