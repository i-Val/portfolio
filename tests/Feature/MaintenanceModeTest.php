<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MaintenanceModeTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_sees_maintenance_page_when_enabled(): void
    {
        Profile::create([
            'name' => 'Site',
            'maintenance_enabled' => true,
            'maintenance_message' => 'We are upgrading.',
        ]);

        $this->get(route('home'))->assertStatus(503);
    }

    public function test_authenticated_user_can_access_site_when_maintenance_enabled(): void
    {
        Profile::create([
            'name' => 'Site',
            'maintenance_enabled' => true,
        ]);

        $user = User::factory()->create();
        $this->actingAs($user)->get(route('home'))->assertOk();
    }
}
