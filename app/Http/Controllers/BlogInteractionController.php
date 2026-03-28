<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogPostComment;
use App\Models\BlogPostLike;
use App\Models\BlogPostShare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogInteractionController extends Controller
{
    public function toggleLike(Request $request, BlogPost $blogPost)
    {
        abort_unless($blogPost->is_published, 404);

        $ip = $request->ip();
        if (! $ip) {
            abort(400);
        }

        $liked = false;

        DB::transaction(function () use ($request, $blogPost, $ip, &$liked) {
            $existing = BlogPostLike::query()
                ->where('blog_post_id', $blogPost->id)
                ->where('ip_address', $ip)
                ->first();

            if ($existing) {
                $existing->delete();
                $liked = false;

                return;
            }

            BlogPostLike::create([
                'blog_post_id' => $blogPost->id,
                'ip_address' => $ip,
                'user_agent' => $request->userAgent(),
            ]);

            $liked = true;
        });

        return response()->json([
            'liked' => $liked,
            'likes' => BlogPostLike::query()->where('blog_post_id', $blogPost->id)->count(),
        ]);
    }

    public function share(Request $request, BlogPost $blogPost)
    {
        abort_unless($blogPost->is_published, 404);

        $validated = $request->validate([
            'platform' => ['nullable', 'string', 'max:50'],
        ]);

        BlogPostShare::create([
            'blog_post_id' => $blogPost->id,
            'platform' => $validated['platform'] ?? null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json([
            'shares' => BlogPostShare::query()->where('blog_post_id', $blogPost->id)->count(),
        ]);
    }

    public function comment(Request $request, BlogPost $blogPost)
    {
        abort_unless($blogPost->is_published, 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'body' => ['required', 'string', 'max:3000'],
        ]);

        BlogPostComment::create([
            'blog_post_id' => $blogPost->id,
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'body' => $validated['body'],
            'is_approved' => true,
        ]);

        return back()->with('status', 'Comment submitted.');
    }
}
