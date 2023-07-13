<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Andrey',
            'email' => 'test@gmail.com',
            'password' => 'Password123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('home');
    }
}
