<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\OrganizationProfile;
use App\Models\SeekerProfile;
use App\Models\JobListing;



#[Fillable(['name', 'email', 'password','role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function organizationProfile(){
        return $this->hasOne(OrganizationProfile::class);
    }
    public function seekerProfile()
    {
        return $this->hasOne(SeekerProfile::class);
    }
    public function jobApplications()
    {
        return $this->hasMany(JobListing::class);
    }
    public function isAdmin():bool
    {
        return $this->role ==='admin';
    }
    public function isOrg(): bool
    {
        return $this->role === 'org';
    }

    public function isSeeker(): bool
    {
        return $this->role === 'seeker';
    }
}
