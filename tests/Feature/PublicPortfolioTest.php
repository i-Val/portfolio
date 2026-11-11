<?php

namespace Tests\Feature;

use App\Models\BlogPost;
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
        $response->assertSee('class="navigation-trigger"', false);
        $response->assertSee('id="main-navigation"', false);
    }

    public function test_blogs_and_single_blog_pages_render_with_nav_button(): void
    {
        $post = BlogPost::create([
            'title' => 'Published Post',
            'slug' => 'published-post',
            'excerpt' => 'Short excerpt',
            'body' => 'Full body content.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $blogsResponse = $this->get(route('blogs'));
        $blogsResponse->assertOk();
        $blogsResponse->assertSee('Published Post');
        $blogsResponse->assertSee('class="navigation-trigger"', false);
        $blogsResponse->assertSee('id="main-navigation"', false);

        $singleResponse = $this->get(route('single-blog', $post->id));
        $singleResponse->assertOk();
        $singleResponse->assertSee('Published Post');
        $singleResponse->assertSee('class="navigation-trigger"', false);
        $singleResponse->assertSee('id="main-navigation"', false);
    }
}
