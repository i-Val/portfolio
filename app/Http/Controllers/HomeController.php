<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogPostView;
use App\Models\ContactMessage;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
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

    public function about(): RedirectResponse
    {
        return redirect()->to(route('home').'#about');
    }

    public function services(): RedirectResponse
    {
        return redirect()->to(route('home').'#services');
    }

    public function portfolio(): RedirectResponse
    {
        return redirect()->to(route('home').'#work');
    }

    public function singleProject($slug)
    {
        $project = Project::query()->where('slug', $slug)->firstOrFail();

        $profile = Profile::query()->first();

        return view('portfolio-show', compact('project', 'profile'));
    }

    public function blogs()
    {
        $profile = Profile::query()->first();

        $posts = BlogPost::query()
            ->where('is_published', true)
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('blog', compact('posts', 'profile'));
    }

    public function singleBlog($id)
    {
        $profile = Profile::query()->first();

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

        return view('blog-post', compact('post', 'stats', 'comments', 'profile'));
    }

    public function contact(): RedirectResponse
    {
        return redirect()->to(route('home').'#contact');
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
