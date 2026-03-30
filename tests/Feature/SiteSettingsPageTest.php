<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteSettingsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_site_settings_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('admin.site-settings.edit'))->assertOk();
    }

    public function test_authenticated_user_can_update_site_settings(): void
    {
        Profile::create([
            'name' => 'Site',
        ]);

        $user = User::factory()->create();

        $response = $this->actingAs($user)->put(route('admin.site-settings.update'), [
            'email' => 'admin@example.com',
            'phone' => '+1 555 0100',
            'location' => 'Example Street',
            'maintenance_enabled' => true,
            'maintenance_message' => 'Down for maintenance.',
            'github_url' => 'https://github.com/example',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('profiles', [
            'email' => 'admin@example.com',
            'phone' => '+1 555 0100',
            'location' => 'Example Street',
            'maintenance_enabled' => 1,
            'maintenance_message' => 'Down for maintenance.',
            'github_url' => 'https://github.com/example',
        ]);
    }
}
