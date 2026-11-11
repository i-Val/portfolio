<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileVisibilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_and_toggle_profile_visibility_flags(): void
    {
        $profile = Profile::create([
            'name' => 'Jane Doe',
            'headline' => 'Principal Systems Engineer',
            'bio' => 'Building resilient backend systems.',
            'birthdate' => '1995-05-15',
            'phone' => '+1 555 0199',
            'location' => '42 Observatory Lane',
            'email' => 'jane@example.com',
        ]);

        $user = User::factory()->create();

        $editResponse = $this->actingAs($user)->get(route('admin.profile.edit'));
        $editResponse->assertOk();
        foreach (['show_birthdate', 'show_name', 'show_headline', 'show_phone', 'show_location', 'show_email'] as $toggle) {
            $editResponse->assertSee('name="'.$toggle.'"', false);
        }

        $updateResponse = $this->actingAs($user)->put(route('admin.profile.update'), [
            'name' => 'Jane Doe',
            'headline' => 'Principal Systems Engineer',
            'bio' => 'Building resilient backend systems.',
            'birthdate' => '1995-05-15',
            'phone' => '+1 555 0199',
            'location' => '42 Observatory Lane',
            'email' => 'jane@example.com',
            'show_birthdate' => '0',
            'show_name' => '0',
            'show_headline' => '0',
            'show_phone' => '0',
            'show_location' => '0',
            'show_email' => '0',
        ]);

        $updateResponse->assertRedirect(route('admin.profile.edit'));

        $profile->refresh();
        $this->assertFalse($profile->show_birthdate);
        $this->assertFalse($profile->show_name);
        $this->assertFalse($profile->show_headline);
        $this->assertFalse($profile->show_phone);
        $this->assertFalse($profile->show_location);
        $this->assertFalse($profile->show_email);
    }

    public function test_public_pages_respect_profile_field_visibility_toggles(): void
    {
        $profile = Profile::create([
            'name' => 'Jane SecretName',
            'headline' => 'Secret Headline Title',
            'bio' => 'Public overview text only.',
            'birthdate' => '1995-05-15',
            'phone' => '+1 555 8899',
            'location' => '99 Hidden Street',
            'email' => 'hidden-contact@example.com',
            'show_birthdate' => true,
            'show_name' => true,
            'show_headline' => true,
            'show_phone' => true,
            'show_location' => true,
            'show_email' => true,
        ]);

        $post = BlogPost::create([
            'title' => 'Sample Article',
            'slug' => 'sample-article',
            'body' => 'Body copy.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $visibleHome = $this->get(route('home'));
        $visibleHome->assertOk();
        $visibleHome->assertSee('15 May 1995');
        $visibleHome->assertSee('Jane SecretName');
        $visibleHome->assertSee('Secret Headline Title');
        $visibleHome->assertSee('+1 555 8899');
        $visibleHome->assertSee('99 Hidden Street');
        $visibleHome->assertSee('hidden-contact@example.com');

        $visibleBlog = $this->get(route('single-blog', $post->id));
        $visibleBlog->assertOk()->assertSee('Jane SecretName');

        $profile->update([
            'show_birthdate' => false,
            'show_name' => false,
            'show_headline' => false,
            'show_phone' => false,
            'show_location' => false,
            'show_email' => false,
        ]);

        $hiddenHome = $this->get(route('home'));
        $hiddenHome->assertOk();
        $hiddenHome->assertDontSee('15 May 1995');
        $hiddenHome->assertDontSee('Jane SecretName');
        $hiddenHome->assertDontSee('Secret Headline Title');
        $hiddenHome->assertDontSee('+1 555 8899');
        $hiddenHome->assertDontSee('99 Hidden Street');
        $hiddenHome->assertDontSee('hidden-contact@example.com');
        $hiddenHome->assertSee('Public overview text only.');

        $hiddenBlog = $this->get(route('single-blog', $post->id));
        $hiddenBlog->assertOk()->assertDontSee('Jane SecretName');
    }

    public function test_site_settings_can_toggle_contact_visibility_without_breaking_partial_updates(): void
    {
        $profile = Profile::create([
            'name' => 'Site Owner',
            'email' => 'owner@example.com',
            'phone' => '+1 555 0100',
            'location' => 'Main Plaza',
        ]);

        $user = User::factory()->create();

        $this->actingAs($user)->put(route('admin.site-settings.update'), [
            'location' => 'Main Plaza',
            'email' => 'owner@example.com',
            'phone' => '+1 555 0100',
            'show_location' => '0',
            'show_email' => '1',
            'show_phone' => '0',
        ])->assertRedirect();

        $profile->refresh();
        $this->assertFalse($profile->show_location);
        $this->assertTrue($profile->show_email);
        $this->assertFalse($profile->show_phone);

        // Partial update without toggle keys leaves existing flags intact
        $this->actingAs($user)->put(route('admin.site-settings.update'), [
            'email' => 'updated@example.com',
        ])->assertRedirect();

        $profile->refresh();
        $this->assertFalse($profile->show_location);
        $this->assertTrue($profile->show_email);
        $this->assertFalse($profile->show_phone);
    }
}
