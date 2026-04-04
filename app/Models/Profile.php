<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'headline',
        'bio',
        'birthdate',
        'phone',
        'email',
        'location',
        'avatar',
        'about_image',
        'logo',
        'resume_url',
        'github_url',
        'linkedin_url',
        'twitter_url',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'dribbble_url',
        'google_plus_url',
        'maintenance_enabled',
        'maintenance_message',
    ];

    protected function casts(): array
    {
        return [
            'birthdate' => 'date',
            'maintenance_enabled' => 'boolean',
        ];
    }
}
