<?php

namespace Tests\Feature;

use App\Domain\Core\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginTrue()
    {
        $credential = [
            'email' => 'user@ad.com',
            'password' => 'user'
        ];
        $response = $this->post('login', $credential);
        $response->assertSessionMissing('errors');
    }

    public function testLoginFalse()
    {
        $credential = [
            'email' => 'user@ad.com',
            'password' => 'incorrectpass'
        ];

        $response = $this->post('login', $credential);
        $response->assertSessionHasErrors();
    }
}
