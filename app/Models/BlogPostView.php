<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPostView extends Model
{
    protected $fillable = [
        'blog_post_id',
        'ip_address',
        'user_agent',
    ];
}
