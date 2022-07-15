<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();
        $this->artisan('passport:install');
        User::factory()->create(100);
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testApiClientLoginPassed()
    {
        $data = ['username' => $this->user->username, 'password' => '12345678'];
        $response = $this->json('POST', '/login', $data);
        $response->assertStatus(Response::HTTP_ACCEPTED)->assertJsonStructure(['data']);
    }
}
