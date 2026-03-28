<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPostShare extends Model
{
    protected $fillable = [
        'blog_post_id',
        'platform',
        'ip_address',
        'user_agent',
    ];
}
