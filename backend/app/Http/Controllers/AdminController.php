<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\JobApplication;
use App\Models\JobListing;
use App\Models\User;

class AdminController extends Controller
{
    public function stats()
    {
        return response()->json([
            'total_users'        => User::where('role', 'seeker')->count(),
            'total_orgs'         => User::where('role', 'org')->count(),
            'total_jobs'         => JobListing::count(),
            'pending_jobs'       => JobListing::where('status', 'pending')->count(),
            'approved_jobs'      => JobListing::where('status', 'approved')->count(),
            'total_applications' => JobApplication::count(),
        ]);
    }

    public function users(Request $request)
    {
        $query = User::query();

        if ($request->has('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(10);

        return UserResource::collection($users);
    }
}