<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPostComment extends Model
{
    protected $fillable = [
        'blog_post_id',
        'name',
        'email',
        'body',
        'is_approved',
    ];

    protected function casts(): array
    {
        return [
            'is_approved' => 'boolean',
        ];
    }
}
