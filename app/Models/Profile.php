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
        'show_skill_percent',
        'show_birthdate',
        'show_name',
        'show_headline',
        'show_phone',
        'show_location',
        'show_email',
    ];

    protected function casts(): array
    {
        return [
            'birthdate' => 'date',
            'maintenance_enabled' => 'boolean',
            'show_logo' => 'boolean',
            'show_skill_percent' => 'boolean',
            'show_birthdate' => 'boolean',
            'show_name' => 'boolean',
            'show_headline' => 'boolean',
            'show_phone' => 'boolean',
            'show_location' => 'boolean',
            'show_email' => 'boolean',
        ];
    }
}
