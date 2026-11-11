<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Seed offered services.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Full-Stack Web Development',
                'icon' => 'fa fa-code',
                'description' => 'End-to-end Laravel and modern JavaScript applications engineered for speed, clarity, and long-term maintainability.',
                'sort_order' => 1,
            ],
            [
                'title' => 'REST & GraphQL API Design',
                'icon' => 'fa fa-server',
                'description' => 'Clean, versioned, and well-documented backend APIs built to power web apps, mobile clients, and third-party integrations.',
                'sort_order' => 2,
            ],
            [
                'title' => 'UI/UX & Monochrome Design Systems',
                'icon' => 'fa fa-paint-brush',
                'description' => 'Minimalist, high-contrast interfaces and reusable component libraries crafted for effortless readability on every screen.',
                'sort_order' => 3,
            ],
            [
                'title' => 'Database Architecture & Tuning',
                'icon' => 'fa fa-database',
                'description' => 'Normalized schema design, index optimization, and query profiling across MySQL, PostgreSQL, and SQLite.',
                'sort_order' => 4,
            ],
            [
                'title' => 'SaaS & Multi-Tenant Platforms',
                'icon' => 'fa fa-cloud',
                'description' => 'Subscription billing, tenant isolation, role-based access control, and background job pipelines for growing SaaS products.',
                'sort_order' => 5,
            ],
            [
                'title' => 'Responsive Frontend Engineering',
                'icon' => 'fa fa-mobile',
                'description' => 'Pixel-accurate responsive layouts using Tailwind CSS, Bootstrap, and accessible semantic HTML across desktop and mobile.',
                'sort_order' => 6,
            ],
            [
                'title' => 'Application Security Audits',
                'icon' => 'fa fa-shield',
                'description' => 'Hardening authentication flows, CSRF/XSS defenses, webhook signature verification, and least-privilege access policies.',
                'sort_order' => 7,
            ],
            [
                'title' => 'DevOps & CI/CD Automation',
                'icon' => 'fa fa-cogs',
                'description' => 'Automated test suites, Docker containerization, zero-downtime deployment pipelines, and environment monitoring.',
                'sort_order' => 8,
            ],
            [
                'title' => 'Performance & Caching Optimization',
                'icon' => 'fa fa-rocket',
                'description' => 'Eliminating N+1 queries, tuning Redis caching strategies, and trimming asset payloads for sub-second page loads.',
                'sort_order' => 9,
            ],
            [
                'title' => 'Technical Consulting & Code Audits',
                'icon' => 'fa fa-line-chart',
                'description' => 'Architecture reviews, legacy codebase refactoring roadmaps, and hands-on mentorship for engineering teams.',
                'sort_order' => 10,
            ],
        ];

        foreach ($services as $item) {
            Service::query()->updateOrCreate(
                ['title' => $item['title']],
                [
                    'description' => $item['description'],
                    'icon' => $item['icon'],
                    'sort_order' => $item['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
