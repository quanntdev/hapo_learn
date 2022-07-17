<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{
    public function testRegister()
    {
        $this->assertGuest();
        $user = User::factory()->make();

        $response = $this->post('/register', [
            'username' => $user->username,
            'email' => $user->email,
            'password' => '12345678!Q',
            'password_confirmation' => '12345678!Q'
        ]);

        $response->assertStatus(302);
    }
}
