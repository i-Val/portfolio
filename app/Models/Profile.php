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
        'maintenance_password',
        'avatar',
        'about_image',
        'hero_image',
        'hero_headline',
        'alternating_text',
        'about_text',
        'logo',
        'favicon',
        'show_logo',
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
            'show_logo' => 'boolean',
        ];
    }
}
