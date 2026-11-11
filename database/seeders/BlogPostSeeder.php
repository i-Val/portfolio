<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BlogPostSeeder extends Seeder
{
    /**
     * Seed sample blog posts.
     */
    public function run(): void
    {
        $sourceImages = [
            public_path('assets/images/blog/blog-post-1.jpg'),
            public_path('assets/images/blog/blog-post-2.jpg'),
            public_path('assets/images/blog/blog-post-3.jpg'),
        ];

        $storedCovers = [];
        foreach ($sourceImages as $index => $sourcePath) {
            if (File::exists($sourcePath)) {
                $targetPath = 'uploads/blog/seeded-' . ($index + 1) . '.jpg';
                Storage::disk('public')->put($targetPath, File::get($sourcePath));
                $storedCovers[] = $targetPath;
            }
        }

        $posts = [
            [
                'title' => 'Designing Modular Laravel Architectures That Scale',
                'slug' => 'designing-modular-laravel-architectures-that-scale',
                'excerpt' => 'Practical patterns for organizing domain logic, action classes, and service boundaries in growing Laravel applications.',
                'body' => "As Laravel codebases grow beyond an MVP, keeping controllers thin and business rules discoverable becomes essential.\n\nBy grouping domain logic around focused action classes, typed DTOs, and explicit event listeners, teams can evolve features independently without tangling unrelated modules.\n\nStart small: extract cohesive workflows into single-purpose classes, lean on database transactions at boundaries, and write feature tests that lock down behavior rather than implementation details.",
                'days_ago' => 3,
            ],
            [
                'title' => 'Zero-Downtime Database Migrations in Production',
                'slug' => 'zero-downtime-database-migrations-in-production',
                'excerpt' => 'How to roll out schema changes safely across live deployments using expand-and-contract patterns.',
                'body' => "Schema changes are one of the trickiest parts of continuous delivery. Locking tables or dropping columns prematurely can break running requests mid-deploy.\n\nThe expand-and-contract workflow avoids downtime by splitting risky migrations into backward-compatible steps: add new nullable columns first, deploy code that writes to both old and new fields, backfill historical data in batches, and only drop legacy columns after all instances run the new release.",
                'days_ago' => 7,
            ],
            [
                'title' => 'Minimalist Monochrome UI: Contrast Without Clutter',
                'slug' => 'minimalist-monochrome-ui-contrast-without-clutter',
                'excerpt' => 'Using typography, spacing, and pure black-and-white contrast to create calm, focused web interfaces.',
                'body' => "Removing color forces every visual decision to rely on hierarchy, weight, and negative space. When an interface uses pitch-black surfaces paired with crisp white typography, content immediately takes center stage.\n\nThe secret to making dark monochrome interfaces legible is discipline: keep subtle hairline borders around #222222, reserve pure white for headings and primary actions, and use muted grays for supporting metadata.",
                'days_ago' => 12,
            ],
            [
                'title' => 'Optimizing SQLite and PostgreSQL Queries with Proper Indexing',
                'slug' => 'optimizing-sqlite-and-postgresql-queries-with-proper-indexing',
                'excerpt' => 'Diagnosing N+1 bottlenecks, composite index order, and query plans before reaching for complex caching.',
                'body' => "Before introducing distributed caches, most web performance bottlenecks can be solved directly in the database layer.\n\nInspecting query plans with EXPLAIN, eliminating N+1 queries through eager loading, and aligning composite indexes with your WHERE and ORDER BY clauses routinely cuts response times by an order of magnitude.",
                'days_ago' => 18,
            ],
            [
                'title' => 'Building Resilient Webhook Consumers with Idempotency Keys',
                'slug' => 'building-resilient-webhook-consumers-with-idempotency-keys',
                'excerpt' => 'Handling duplicate deliveries, signature verification, and asynchronous retries reliably in PHP.',
                'body' => "External payment and notification providers guarantee at-least-once delivery, meaning your webhook endpoints will inevitably receive duplicate events.\n\nAlways verify cryptographic signatures up front, persist a unique event identifier before queuing background processing, and design every job handler to be safely idempotent.",
                'days_ago' => 24,
            ],
            [
                'title' => 'Clean API Versioning Strategies for Long-Lived Clients',
                'slug' => 'clean-api-versioning-strategies-for-long-lived-clients',
                'excerpt' => 'Balancing backward compatibility with iterative backend improvements for web and mobile consumers.',
                'body' => "Public and mobile APIs outlive individual frontend deployments. Once a client ships, breaking payload shapes can strand older app versions.\n\nExplicit URI or header versioning paired with dedicated API Resource transformers keeps contract evolution predictable and prevents accidental leakage of internal database column changes.",
                'days_ago' => 31,
            ],
            [
                'title' => 'Caching Patterns: Tags, Stale-While-Revalidate, and Busting',
                'slug' => 'caching-patterns-tags-stale-while-revalidate-and-busting',
                'excerpt' => 'Choosing the right caching layer and invalidation strategy without serving stale surprises.',
                'body' => "Caching turns expensive aggregations into sub-millisecond reads, but premature or poorly scoped cache keys can create hard-to-reproduce bugs.\n\nFavor explicit cache invalidation tied to model lifecycle hooks or short TTLs combined with atomic locks to prevent cache stampedes during traffic spikes.",
                'days_ago' => 39,
            ],
            [
                'title' => 'Practical Feature Testing in Laravel Without Slow Suites',
                'slug' => 'practical-feature-testing-in-laravel-without-slow-suites',
                'excerpt' => 'Structuring fast, reliable end-to-end HTTP tests that catch regressions early.',
                'body' => "A test suite only remains useful if developers actually run it before every commit. Keeping tests fast requires isolating external APIs with HTTP fakes, using lightweight database transactions, and seeding only the minimal records each scenario needs.",
                'days_ago' => 45,
            ],
            [
                'title' => 'Hardening Authentication Flows and Session Security',
                'slug' => 'hardening-authentication-flows-and-session-security',
                'excerpt' => 'Essential checklists for CSRF protection, rate limiting, and secure cookie flags in modern web apps.',
                'body' => "Security is built from sensible defaults layered consistently across every route. Rate-limiting login and contact endpoints, regenerating session IDs upon privilege changes, and enforcing strict validation rules protect users without degrading the user experience.",
                'days_ago' => 52,
            ],
            [
                'title' => 'Designing Responsive CSS Grids Without Heavy Frameworks',
                'slug' => 'designing-responsive-css-grids-without-heavy-frameworks',
                'excerpt' => 'Creating balanced multi-column card layouts with CSS Grid, Flexbox, and consistent card alignment.',
                'body' => "Consistent card heights and clean gutters make content-heavy pages effortless to scan. Combining CSS Flexbox inside equal-height grid columns keeps card titles, excerpts, and footer actions aligned regardless of text length.",
                'days_ago' => 60,
            ],
            [
                'title' => 'Queue Workers, Backoff Strategies, and Failed Job Recovery',
                'slug' => 'queue-workers-backoff-strategies-and-failed-job-recovery',
                'excerpt' => 'Keeping background processing healthy under transient network failures and burst traffic.',
                'body' => "Offloading email delivery, media processing, and third-party syncs to background queues keeps HTTP requests snappy. Pairing exponential backoff with dead-letter monitoring ensures temporary outages recover gracefully without manual intervention.",
                'days_ago' => 68,
            ],
            [
                'title' => 'From Monolith to Maintainable Domain Packages',
                'slug' => 'from-monolith-to-maintainable-domain-packages',
                'excerpt' => 'Why a well-structured modular monolith often beats premature microservices for small teams.',
                'body' => "Distributed systems introduce network latency, eventual consistency, and operational overhead. Most teams gain far more velocity from a modular monolith with crisp internal interfaces and shared deployment pipelines.",
                'days_ago' => 75,
            ],
        ];

        foreach ($posts as $index => $item) {
            $coverImage = ! empty($storedCovers)
                ? $storedCovers[$index % count($storedCovers)]
                : null;

            BlogPost::query()->updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'title' => $item['title'],
                    'excerpt' => $item['excerpt'],
                    'body' => $item['body'],
                    'cover_image' => $coverImage,
                    'is_published' => true,
                    'published_at' => now()->subDays($item['days_ago']),
                ]
            );
        }
    }
}
