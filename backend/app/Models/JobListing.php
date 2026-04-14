
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'organization_id',
        'title',
        'description',
        'location',
        'type',
        'salary_range',
        'status',
        'deadline',
    ];

    public function organization(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(OrganizationProfile::class, 'organization_id');
    }

    public function applications(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }
}