<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPortfolioTest extends TestCase
{
    use RefreshDatabase;

    public function test_portfolio_list_renders_titles_and_links(): void
    {
        Project::create([
            'title' => 'Test Project',
            'slug' => 'test-project',
            'description' => 'This is a test project description.',
            'category' => 'Web',
        ]);

        $response = $this->get(route('portfolio'));

        $response->assertOk();
        $response->assertSee('Test Project');
        $response->assertSee(route('portfolio.show', 'test-project'), false);
    }

    public function test_project_details_page_renders(): void
    {
        Project::create([
            'title' => 'Detail Project',
            'slug' => 'detail-project',
            'description' => 'Detail description',
        ]);

        $response = $this->get(route('portfolio.show', 'detail-project'));
        $response->assertOk();
        $response->assertSee('Detail Project');
        $response->assertSee('Detail description');
    }
}
