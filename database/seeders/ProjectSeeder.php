<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProjectSeeder extends Seeder
{
    /**
     * Seed sample portfolio projects.
     */
    public function run(): void
    {
        $storedImages = [];
        for ($i = 1; $i <= 8; $i++) {
            $sourcePath = public_path("assets/images/projects/{$i}.jpg");
            if (File::exists($sourcePath)) {
                $targetPath = "uploads/projects/seeded-{$i}.jpg";
                Storage::disk('public')->put($targetPath, File::get($sourcePath));
                $storedImages[] = $targetPath;
            }
        }

        $projects = [
            [
                'title' => 'PulsePay Billing Engine',
                'slug' => 'pulsepay-billing-engine',
                'category' => 'SaaS Platform',
                'description' => "Multi-tenant subscription billing and metered invoicing engine built with Laravel, Redis queues, and webhook idempotency.\n\nSupports automated proration, dunning workflows, PDF invoice generation, and real-time MRR analytics.",
                'project_url' => 'https://example.com/projects/pulsepay',
                'sort_order' => 1,
                'is_featured' => true,
            ],
            [
                'title' => 'Noir Commerce Storefront',
                'slug' => 'noir-commerce-storefront',
                'category' => 'E-Commerce',
                'description' => "High-contrast headless e-commerce platform designed for independent apparel and studio brands.\n\nFeatures instant inventory filtering, persistent carts, Stripe checkout integration, and an order fulfillment dashboard.",
                'project_url' => 'https://example.com/projects/noir-commerce',
                'sort_order' => 2,
                'is_featured' => true,
            ],
            [
                'title' => 'MedicCore Telehealth Portal',
                'slug' => 'mediccore-telehealth-portal',
                'category' => 'Web Application',
                'description' => "HIPAA-conscious patient scheduling, encrypted clinical notes, and appointment triage portal.\n\nBuilt with role-based permissions, audit logging, and real-time clinician availability calendars.",
                'project_url' => 'https://example.com/projects/mediccore',
                'sort_order' => 3,
                'is_featured' => true,
            ],
            [
                'title' => 'VectorDocs API Gateway',
                'slug' => 'vectordocs-api-gateway',
                'category' => 'API & Backend',
                'description' => "Developer documentation portal and rate-limited API gateway with interactive endpoint sandboxes.\n\nIncludes per-tenant API token scoping, usage telemetry, and automated OpenAPI schema validation.",
                'project_url' => 'https://example.com/projects/vectordocs',
                'sort_order' => 4,
                'is_featured' => true,
            ],
            [
                'title' => 'Kinetix Fleet Tracker',
                'slug' => 'kinetix-fleet-tracker',
                'category' => 'Logistics & IoT',
                'description' => "Real-time dispatch and delivery route monitor ingesting telemetry events over WebSockets.\n\nDelivers live driver ETA updates, geofence alerts, and automated end-of-shift route summaries.",
                'project_url' => 'https://example.com/projects/kinetix',
                'sort_order' => 5,
                'is_featured' => false,
            ],
            [
                'title' => 'Monolith UI Design System',
                'slug' => 'monolith-ui-design-system',
                'category' => 'Design System',
                'description' => "Accessible black-and-white component library packaged for Vue, React, and Blade templates.\n\nIncludes keyboard-navigable modals, data tables, form primitives, and strict WCAG contrast tokens.",
                'project_url' => 'https://example.com/projects/monolith-ui',
                'sort_order' => 6,
                'is_featured' => false,
            ],
            [
                'title' => 'Chronicle Editorial CMS',
                'slug' => 'chronicle-editorial-cms',
                'category' => 'Content Platform',
                'description' => "Focused publishing workflow for independent writers with markdown revisions, scheduled drops, and reader engagement metrics.\n\nTracks unique reads, shares, and moderated comment threads without third-party trackers.",
                'project_url' => 'https://example.com/projects/chronicle',
                'sort_order' => 7,
                'is_featured' => false,
            ],
            [
                'title' => 'VaultEnv Secrets Manager',
                'slug' => 'vaultenv-secrets-manager',
                'category' => 'Developer Tools',
                'description' => "Encrypted environment variable vault and CLI sync tool for distributed engineering teams.\n\nSupports per-environment encryption keys, rotation reminders, and CI/CD secret injection.",
                'project_url' => 'https://example.com/projects/vaultenv',
                'sort_order' => 8,
                'is_featured' => false,
            ],
            [
                'title' => 'LedgerFlow Expense Suite',
                'slug' => 'ledgerflow-expense-suite',
                'category' => 'FinTech',
                'description' => "Automated receipt capture, approval routing, and CSV/accounting ledger exports for remote teams.\n\nFeatures multi-currency conversion, policy threshold rules, and monthly budget forecasting.",
                'project_url' => 'https://example.com/projects/ledgerflow',
                'sort_order' => 9,
                'is_featured' => false,
            ],
            [
                'title' => 'Beacon Uptime Monitor',
                'slug' => 'beacon-uptime-monitor',
                'category' => 'Cloud & DevOps',
                'description' => "Lightweight synthetic HTTP and SSL certificate monitor with multi-channel webhook alerts.\n\nGenerates public status pages, latency percentiles, and automated incident timelines.",
                'project_url' => 'https://example.com/projects/beacon',
                'sort_order' => 10,
                'is_featured' => false,
            ],
        ];

        foreach ($projects as $index => $item) {
            $imagePath = ! empty($storedImages)
                ? $storedImages[$index % count($storedImages)]
                : null;

            Project::query()->updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'image' => $imagePath,
                    'project_url' => $item['project_url'],
                    'category' => $item['category'],
                    'sort_order' => $item['sort_order'],
                    'is_featured' => $item['is_featured'],
                ]
            );
        }
    }
}
