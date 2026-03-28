<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogPostView;
use App\Models\ContactMessage;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function home()
    {
        $profile = Profile::query()->first();
        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('title')
            ->limit(6)
            ->get();
        $projects = Project::query()
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();
        $posts = BlogPost::query()
            ->where('is_published', true)
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        return view('home', compact('profile', 'services', 'projects', 'posts'));
    }

    public function about()
    {
        $profile = Profile::query()->first();

        return view('about', compact('profile'));
    }

    public function services()
    {
        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('services', compact('services'));
    }

    public function portfolio()
    {
        $projects = Project::query()
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        return view('portfolio', compact('projects'));
    }

    public function blogs()
    {
        $posts = BlogPost::query()
            ->where('is_published', true)
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('blog', compact('posts'));
    }

    public function singleBlog($id)
    {
        $post = BlogPost::query()
            ->where('is_published', true)
            ->findOrFail($id);

        $sessionKey = 'blog_post_viewed_'.$post->id;
        if (! Session::has($sessionKey)) {
            BlogPostView::create([
                'blog_post_id' => $post->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
            Session::put($sessionKey, true);
        }

        $stats = [
            'views' => $post->views()->count(),
            'likes' => $post->likes()->count(),
            'shares' => $post->shares()->count(),
            'comments' => $post->comments()->where('is_approved', true)->count(),
        ];

        $comments = $post->comments()
            ->where('is_approved', true)
            ->orderByDesc('created_at')
            ->limit(50)
            ->get();

        $liked = false;
        $ip = request()->ip();
        if ($ip) {
            $liked = $post->likes()->where('ip_address', $ip)->exists();
        }

        return view('single-blog', compact('post', 'stats', 'comments', 'liked'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        ContactMessage::create([
            ...$validated,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('status', 'Message sent successfully.');
    }
}
