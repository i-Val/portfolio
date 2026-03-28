<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPostLike extends Model
{
    protected $fillable = [
        'blog_post_id',
        'ip_address',
        'user_agent',
    ];
}
