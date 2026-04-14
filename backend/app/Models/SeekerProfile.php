<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeekerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'headline',
        'bio',
        'phone',
        'country',
        'city',
        'open_to_remote',
        'available',
    ];

    protected function casts(): array
    {
        return [
            'open_to_remote' => 'boolean',
            'available' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}