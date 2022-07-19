<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{
    public function testCanLogin()
    {
        $this->assertGuest();
        $user = User::factory()->create([
            'password' => Hash::make('12345678'),
        ]);

        $this->post('/login', [
            'username' => $user->username,
            'password' => '12345678',
        ])
            ->assertStatus(302)
            ->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }
}
