<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogPostComment;
use App\Models\BlogPostLike;
use App\Models\BlogPostShare;
use App\Models\BlogPostView;
use App\Models\ContactMessage;
use App\Models\Service;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $blogPostsTotal = BlogPost::query()->count();
        $blogPostsPublished = BlogPost::query()->where('is_published', true)->count();

        $servicesTotal = Service::query()->count();
        $servicesActive = Service::query()->where('is_active', true)->count();

        $contactTotal = ContactMessage::query()->count();
        $contactUnread = ContactMessage::query()->where('is_read', false)->count();

        $engagement = [
            'views' => BlogPostView::query()->count(),
            'likes' => BlogPostLike::query()->count(),
            'shares' => BlogPostShare::query()->count(),
            'comments' => BlogPostComment::query()->where('is_approved', true)->count(),
        ];

        $categories = $this->lastNDaysCategories(14);
        $dateKeys = collect($categories['keys']);

        $activity = [
            'blog_posts' => $this->countsByDate(BlogPost::query(), $dateKeys),
            'services' => $this->countsByDate(Service::query(), $dateKeys),
            'contact_messages' => $this->countsByDate(ContactMessage::query(), $dateKeys),
        ];

        $viewsByDay = $this->countsByDate(BlogPostView::query(), $dateKeys);

        return view('admin.dashboard', compact(
            'blogPostsTotal',
            'blogPostsPublished',
            'servicesTotal',
            'servicesActive',
            'contactTotal',
            'contactUnread',
            'engagement',
            'categories',
            'activity',
            'viewsByDay',
        ));
    }

    private function lastNDaysCategories(int $days): array
    {
        $today = CarbonImmutable::today();
        $start = $today->subDays($days - 1);

        $keys = [];
        $labels = [];

        for ($i = 0; $i < $days; $i++) {
            $d = $start->addDays($i);
            $keys[] = $d->format('Y-m-d');
            $labels[] = $d->format('d M');
        }

        return [
            'keys' => $keys,
            'labels' => $labels,
        ];
    }

    private function countsByDate($query, Collection $dateKeys): array
    {
        $start = CarbonImmutable::createFromFormat('Y-m-d', $dateKeys->first())->startOfDay();

        $rows = $query
            ->where('created_at', '>=', $start)
            ->get(['created_at'])
            ->groupBy(function ($row) {
                return $row->created_at->format('Y-m-d');
            })
            ->map(function ($items) {
                return $items->count();
            });

        return $dateKeys->map(function ($key) use ($rows) {
            return (int) ($rows[$key] ?? 0);
        })->all();
    }
}
