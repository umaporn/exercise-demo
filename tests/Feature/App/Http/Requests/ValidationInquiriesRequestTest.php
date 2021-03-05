<?php

namespace Tests\Feature\App\Http\Requests;

use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Inquiries;

class ValidationInquiriesRequestTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_should_fail_validation_when_submit_inquiries_without_name()
    {
        $response = $this->post( '/contact', [
            'email'   => 'john@gmail.com',
            'phone'   => '123456789',
            'message' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
        ] );

        $response->assertSessionHasErrors( [ 'name' ] );
    }

    /** @test */
    public function it_should_fail_name_is_longer_than_50()
    {
        $response = $this->post( '/contact', [
            'name' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
        ] );

        $response->assertSessionHasErrors( [ 'name' ] );
    }

    /** @test */
    public function it_should_fail_validation_when_submit_inquiries_without_email()
    {
        $response = $this->post( '/contact', [
            'name'    => 'john',
            'phone'   => '123456789',
            'message' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
        ] );

        $response->assertSessionHasErrors( [ 'email' ] );
    }

    /** @test */
    public function it_should_fail_email_is_longer_than_50()
    {
        $response = $this->post( '/contact', [
            'email' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
        ] );

        $response->assertSessionHasErrors( [ 'email' ] );
    }

    /** @test */
    public function it_should_fail_email_is_invalid()
    {
        $response = $this->post( '/contact', [
            'email' => 'test',
        ] );

        $response->assertSessionHasErrors( [ 'email' ] );
    }

    /** @test */
    public function it_should_fail_validation_when_submit_inquiries_without_phone()
    {
        $response = $this->post( '/contact', [
            'name'    => 'john',
            'email'   => 'john@gmail.com',
            'message' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
        ] );

        $response->assertSessionHasErrors( [ 'phone' ] );
    }

    /** @test */
    public function it_should_fail_validation_when_submit_inquiries_without_message()
    {
        $response = $this->post( '/contact', [
            'name'  => 'john',
            'email' => 'john@gmail.com',
            'phone' => '12345678',
        ] );

        $response->assertSessionHasErrors( [ 'message' ] );
    }

    /** @test */
    public function it_should_fail_message_is_longer_than_500()
    {
        $response = $this->post( '/contact', [
            'message' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        ] );

        $response->assertSessionHasErrors( [ 'message' ] );
    }
}