<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_register()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'User created successfully',
                     'user' => [
                         'name' => 'John Doe',
                         'email' => 'john.doe@example.com',
                     ]
                 ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com',
        ]);
    }

    /** @test */
    public function registration_requires_a_name_email_and_password()
    {
        $response = $this->postJson('/api/register', [
            'name' => '',
            'email' => '',
            'password' => ''
        ]);

        $response->assertStatus(400);

        // Verificar a estrutura da resposta de validação
        $response->assertJsonStructure([
            'message',
            'errors' => ['name', 'email', 'password'],
        ]);
    }

    // /** @test */
    // public function email_must_be_unique()
    // {
    //     User::factory()->create(['email' => 'john.doe@example.com']);

    //     $response = $this->postJson('/api/register', [
    //         'name' => 'John Doe',
    //         'email' => 'john.doe@example.com',
    //         'password' => 'password123',
    //         'password_confirmation' => 'password123',
    //     ]);

    //     $response->assertStatus(400);

    //     // Verificar a estrutura da resposta de validação
    //     $response->assertJsonStructure([
    //         'message',
    //         'errors' => ['email'],
    //     ]);
    // }
}
