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
        $response = $this->post('/contact', [
            'name'    => 'john',
            'email'   => 'john@gmail.com',
            'phone'   => '123456789',
            'message' => 'greeting text',
            'start_date' => '2022-11-20 08:00:00',
            'end_date' => '2022-11-21 17:00:00',
            'need_on_site_service' => true,
            'address' => '2828 Walker Field Dr,	Grand Junction',
        ]);

        $response->assertOk();

        $this->assertDatabaseHas('inquiries', [
            'name'    => 'john',
            'email'   => 'john@gmail.com',
            'phone'   => '123456789',
            'message' => 'greeting text',
            'start_date' => '2022-11-20 08:00:00',
            'end_date' => '2022-11-21 17:00:00',
            'need_on_site_service' => true,
            'address' => '2828 Walker Field Dr,	Grand Junction',
        ]);
    }

    public function test_inquiries_notification_is_sent(): void
    {
        Notification::fake();

        $response = $this->post('/contact', [
            'name'    => 'umaporn',
            'email'   => 'umaporn.don@gmail.com',
            'phone'   => '123456789',
            'message' => 'greeting text',
            'start_date' => '2022-11-20 08:00:00',
            'end_date' => '2022-11-21 17:00:00',
            'need_on_site_service' => true,
            'address' => '2828 Walker Field Dr,	Grand Junction',
        ]);

        Notification::assertSentTo(
            [Inquiries::where(['email' => 'umaporn.don@gmail.com'])->first()],
            InquiriesNotifications::class
        );
    }
}
