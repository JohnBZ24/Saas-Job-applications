<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\OrganizationProfileController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\SeekerProfileController;
use App\Http\Controllers\AdminJobController;
use App\Http\Controllers\AdminController;

// Public — anyone can browse jobs
Route::get('/jobs', [JobListingController::class, 'index']);
Route::get('/jobs/{job}', [JobListingController::class, 'show']);

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Org routes
    Route::middleware('role:org')->prefix('org')->group(function () {
        Route::get('/profile', [OrganizationProfileController::class, 'show']);
        Route::put('/profile', [OrganizationProfileController::class, 'update']);
        Route::post('/jobs', [JobListingController::class, 'store']);
        Route::put('/jobs/{job}', [JobListingController::class, 'update']);
        Route::delete('/jobs/{job}', [JobListingController::class, 'destroy']);
        Route::get('/jobs/{job}/applicants', [JobApplicationController::class, 'applicants']);
        Route::get('/my-jobs', [JobListingController::class, 'myJobs']);
    });

    // Seeker routes
    Route::middleware('role:seeker')->prefix('seeker')->group(function () {
        Route::get('/profile', [SeekerProfileController::class, 'show']);
        Route::put('/profile', [SeekerProfileController::class, 'update']);
        Route::post('/jobs/{job}/apply', [JobApplicationController::class, 'store']);
        Route::get('/my-applications', [JobApplicationController::class, 'myApplications']);
    });

    // Admin routes
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/jobs', [AdminJobController::class, 'index']);
        Route::patch('/jobs/{job}/approve', [AdminJobController::class, 'approve']);
        Route::patch('/jobs/{job}/reject', [AdminJobController::class, 'reject']);
        Route::get('/stats', [AdminController::class, 'stats']);
        Route::get('/users', [AdminController::class, 'users']);
    });
});