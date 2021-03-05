<?php

namespace Tests\Feature;

use App\Models\Inquiries;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use App\Notifications\InquiriesNotifications;

class ContactControllerTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_should_create_inquiries_successfully(): void
    {
        $response = $this->post( '/contact', [
            'name'    => 'john',
            'email'   => 'john@gmail.com',
            'phone'   => '123456789',
            'message' => 'greeting text',
        ] );

        $response->assertOk();

        $this->assertDatabaseHas( 'inquiries', [
            'name'    => 'john',
            'email'   => 'john@gmail.com',
            'phone'   => '123456789',
            'message' => 'greeting text',
        ] );
    }

    public function test_inquiries_notification_is_sent(): void
    {
        Notification::fake();

        $response = $this->post( '/contact', [
            'name'    => 'umaporn',
            'email'   => 'umaporn.don@gmail.com',
            'phone'   => '123456789',
            'message' => 'greeting text',
        ] );

        Notification::assertSentTo(
            [ Inquiries::where( ['email' => 'umaporn.don@gmail.com'] )->first() ],
            InquiriesNotifications::class
        );

    }

}
