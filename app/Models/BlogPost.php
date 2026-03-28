<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'cover_image',
        'is_published',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function views(): HasMany
    {
        return $this->hasMany(BlogPostView::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(BlogPostLike::class);
    }

    public function shares(): HasMany
    {
        return $this->hasMany(BlogPostShare::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(BlogPostComment::class);
    }
}
