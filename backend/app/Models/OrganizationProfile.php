<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationProfile extends Model
{
    protected $fillable = [
        'user_id',
        'company_name',
        'description',
        'website',
        'industry',
        'phone',
        'email',
        'country',
        'city',
        'address',
        'plan',
        'max_free_posts',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function joblisting()
    {
        return $this->hasMany(Joblisting::class,'organization_id');
    }
        public function canPost(): bool
    {
        if ($this->plan === 'pro') {
            return true;
        }

        return $this->jobListings()->count() < $this->max_free_posts;
    }
}
