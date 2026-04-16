<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobApplicationRequest;
use App\Http\Resources\JobApplicationResource;
use App\Models\JobApplication;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    // Seeker — apply to a job
    public function store(StoreJobApplicationRequest $request, JobListing $job)
    {
        if ($job->status !== 'approved') {
            return response()->json(['message' => 'Job not available'], 404);
        }

        // check if already applied
        $existing = JobApplication::where('user_id', $request->user()->id)
            ->where('job_id', $job->id)
            ->first();

        if ($existing) {
            return response()->json(['message' => 'You already applied to this job'], 409);
        }

        $application = JobApplication::create([
            'job_id'  => $job->id,
            'user_id' => $request->user()->id,
            'status'  => 'applied',
            'message' => $request->message,
        ]);

        return new JobApplicationResource($application);
    }

    // Seeker — see my applications
    public function myApplications(Request $request)
    {
        $applications = JobApplication::with('jobListing.organization')
            ->where('user_id', $request->user()->id)
            ->latest('id')
            ->paginate(10);

        return JobApplicationResource::collection($applications);
    }

    // Org — see who applied to their job
    public function applicants(Request $request, JobListing $job)
    {
        $org = $request->user()->organizationProfile;

        if ($job->organization_id !== $org->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $applications = $job->applications()
            ->with('user')
            ->paginate(10);

        return JobApplicationResource::collection($applications);
    }
}