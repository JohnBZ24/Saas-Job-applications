<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobListingRequest;
use App\Http\Resources\JobListingResource;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    // Public — anyone can see approved jobs
    public function index()
    {
        $jobs = JobListing::with('organization')
            ->where('status', 'approved')
            ->latest()
            ->paginate(10);

        return JobListingResource::collection($jobs);
    }

    // Public — single job detail
    public function show(JobListing $job)
    {
        if ($job->status !== 'approved') {
            return response()->json(['message' => 'Not found'], 404);
        }

        $job->load('organization');

        return new JobListingResource($job);
    }

    // Org — create a job
    public function store(StoreJobListingRequest $request)
    {
        $org = $request->user()->organizationProfile;

        if (!$org->canPost()) {
            return response()->json([
                'message' => 'You have reached your posting limit',
                'upgrade' => true,
            ], 403);
        }

        $job = $org->jobListings()->create($request->validated());

        return new JobListingResource($job);
    }

    // Org — update their own job
    public function update(StoreJobListingRequest $request, JobListing $job)
    {
        $org = $request->user()->organizationProfile;

        if ($job->organization_id !== $org->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $job->update($request->validated());

        return new JobListingResource($job);
    }

    // Org — delete their own job
    public function destroy(Request $request, JobListing $job)
    {
        $org = $request->user()->organizationProfile;

        if ($job->organization_id !== $org->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $job->delete();

        return response()->json(['message' => 'Job deleted']);
    }

    // Org — see their own job listings
    public function myJobs(Request $request)
    {
        $org = $request->user()->organizationProfile;

        $jobs = $org->jobListings()->latest()->paginate(10);

        return JobListingResource::collection($jobs);
    }
}