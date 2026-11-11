<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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

    public function test_portfolio_show_and_home_display_multiple_angle_images(): void
    {
        $project = Project::create([
            'title' => 'Studio Photography Kit',
            'slug' => 'studio-photography-kit',
            'description' => 'Hardware build showcase from multiple perspectives.',
            'image' => 'uploads/projects/cover.jpg',
            'category' => 'Product Design',
            'sort_order' => 1,
        ]);

        $project->images()->createMany([
            [
                'image_path' => 'uploads/projects/angle-1.jpg',
                'caption' => 'Side Dashboard',
                'sort_order' => 0,
            ],
            [
                'image_path' => 'uploads/projects/angle-2.jpg',
                'caption' => 'Mobile Dark View',
                'sort_order' => 1,
            ],
        ]);

        $homeResponse = $this->get(route('home'));
        $homeResponse->assertOk();
        $homeResponse->assertSee('photo_library');
        $homeResponse->assertSee('3 angles');

        $showResponse = $this->get(route('portfolio.show', $project->slug));
        $showResponse->assertOk();
        $showResponse->assertSee('data-project-gallery', false);
        $showResponse->assertSee('3 Angles');
        $showResponse->assertSee('Main View');
        $showResponse->assertSee('Side Dashboard');
        $showResponse->assertSee('Mobile Dark View');
        $showResponse->assertSee('1 / 3');
        $showResponse->assertSee(Storage::url('uploads/projects/cover.jpg'), false);
        $showResponse->assertSee(Storage::url('uploads/projects/angle-1.jpg'), false);
        $showResponse->assertSee(Storage::url('uploads/projects/angle-2.jpg'), false);
    }

    public function test_admin_can_upload_update_and_delete_multiple_angle_images(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $storeResponse = $this->actingAs($user)->post(route('admin.projects.store'), [
            'title' => 'Multi Angle Case Study',
            'category' => 'Hardware',
            'description' => 'Multi-angle case study description.',
            'image' => UploadedFile::fake()->image('cover.jpg'),
            'gallery_images' => [
                UploadedFile::fake()->image('angle-a.jpg'),
                UploadedFile::fake()->image('angle-b.jpg'),
            ],
            'gallery_captions' => [
                'Front Isometric',
                'Rear Circuit View',
            ],
        ]);

        $storeResponse->assertRedirect(route('admin.projects.index'));

        $project = Project::query()
            ->where('slug', 'multi-angle-case-study')
            ->with('images')
            ->firstOrFail();

        $this->assertNotNull($project->image);
        Storage::disk('public')->assertExists($project->image);
        $this->assertCount(2, $project->images);
        $this->assertSame(['Front Isometric', 'Rear Circuit View'], $project->images->pluck('caption')->all());
        Storage::disk('public')->assertExists($project->images[0]->image_path);
        Storage::disk('public')->assertExists($project->images[1]->image_path);

        $firstAngle = $project->images[0];
        $removedAngle = $project->images[1];

        $updateResponse = $this->actingAs($user)->put(route('admin.projects.update', $project), [
            'title' => 'Multi Angle Case Study',
            'category' => 'Hardware',
            'description' => 'Updated description.',
            'existing_captions' => [
                $firstAngle->id => 'Updated Front View',
            ],
            'existing_sort_orders' => [
                $firstAngle->id => 5,
            ],
            'delete_gallery_images' => [
                $removedAngle->id,
            ],
            'gallery_images' => [
                UploadedFile::fake()->image('angle-c.jpg'),
            ],
            'gallery_captions' => [
                'Macro Detail',
            ],
        ]);

        $updateResponse->assertRedirect(route('admin.projects.index'));
        Storage::disk('public')->assertMissing($removedAngle->image_path);

        $project->refresh()->load('images');
        $this->assertCount(2, $project->images);
        $this->assertSame(['Updated Front View', 'Macro Detail'], $project->images->pluck('caption')->all());
        Storage::disk('public')->assertExists($project->images[1]->image_path);

        $sharedProject = Project::create([
            'title' => 'Shared Asset Project',
            'slug' => 'shared-asset-project',
            'image' => $project->image,
        ]);

        $remainingAnglePath = $project->images[0]->image_path;
        $coverPath = $project->image;

        $this->actingAs($user)
            ->delete(route('admin.projects.destroy', $project))
            ->assertRedirect(route('admin.projects.index'));

        Storage::disk('public')->assertExists($coverPath);
        Storage::disk('public')->assertMissing($remainingAnglePath);

        $this->assertDatabaseHas('projects', ['id' => $sharedProject->id]);
    }

    public function test_admin_can_toggle_project_featured_status(): void
    {
        $project = Project::create([
            'title' => 'Toggleable Project',
            'slug' => 'toggleable-project',
            'is_featured' => false,
        ]);

        $this->patch(route('admin.projects.toggle-featured', $project))
            ->assertRedirect(route('login'));

        $user = User::factory()->create();

        $indexResponse = $this->actingAs($user)->get(route('admin.projects.index'));
        $indexResponse->assertOk();
        $indexResponse->assertSee(route('admin.projects.toggle-featured', $project), false);
        $indexResponse->assertSee('js-featured-toggle-form', false);

        $jsonResponse = $this->actingAs($user)->patchJson(
            route('admin.projects.toggle-featured', $project),
            ['is_featured' => true]
        );
        $jsonResponse->assertOk()
            ->assertJson([
                'is_featured' => true,
                'message' => 'Portfolio item marked as featured.',
            ]);
        $this->assertTrue((bool) $project->fresh()->is_featured);

        $formResponse = $this->actingAs($user)->patch(route('admin.projects.toggle-featured', $project));
        $formResponse->assertRedirect(route('admin.projects.index'))
            ->assertSessionHas('status', 'Portfolio item removed from featured.');
        $this->assertFalse((bool) $project->fresh()->is_featured);
    }
}
