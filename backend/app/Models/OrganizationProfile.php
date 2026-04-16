<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    protected function casts(): array
    {
        return [
            'plan' => \App\Enums\Plan::class,
            'max_free_posts' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jobListings(): HasMany
    {
        return $this->hasMany(JobListing::class, 'organization_id');
    }

    public function canPost(): bool
    {
        if ($this->plan === \App\Enums\Plan::Pro) {
            return true;
        }

        return $this->jobListings()->count() < $this->max_free_posts;
    }
}
