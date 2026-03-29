<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactMessageSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_submit_contact_message(): void
    {
        $response = $this->post(route('contact.submit'), [
            'name' => 'Guest User',
            'email' => 'guest@example.com',
            'subject' => 'Hello',
            'message' => 'Test message',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('contact_messages', [
            'email' => 'guest@example.com',
            'subject' => 'Hello',
            'message' => 'Test message',
        ]);
    }
}

