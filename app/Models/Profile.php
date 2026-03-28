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
        'resume_url',
        'github_url',
        'linkedin_url',
        'twitter_url',
    ];

    protected function casts(): array
    {
        return [
            'birthdate' => 'date',
        ];
    }
}
