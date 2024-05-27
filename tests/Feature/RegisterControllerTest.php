<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_register()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'message',
            'user' => [
                'id',
                'name',
                'email',
                'created_at',
                'updated_at',
            ],
        ]);
    }

    /** @test */
    public function registration_requires_a_name_email_and_password()
    {
        $response = $this->postJson('/api/register', [
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertStatus(400);
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'name', 
                'email', 
                'password',
            ],
        ]);
    }

    /** @test */
    public function email_must_be_unique()
    {
        User::factory()->create(['email' => 'user@example.com']);

        $response = $this->postJson('/api/register', [
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(400);
        $response->assertJsonStructure([
            'message',
            'errors' => ['email'],
        ]);
    }
}
