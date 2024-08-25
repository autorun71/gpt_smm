<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_users()
    {
        $user = User::factory()->create();

        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
                 ->assertJsonFragment(['email' => $user->email]);
    }

    /** @test */
    public function it_can_show_a_user()
    {
        $user = User::factory()->create();

        $response = $this->getJson("/api/users/{$user->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['email' => $user->email]);
    }

    /** @test */
    public function it_can_create_a_user()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password',
        ];

        $response = $this->postJson('/api/users', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['email' => 'testuser@example.com']);

        $this->assertDatabaseHas('users', ['email' => 'testuser@example.com']);
    }

    /** @test */
    public function it_can_update_a_user()
    {
        $user = User::factory()->create();

        $data = ['name' => 'Updated Name'];

        $response = $this->putJson("/api/users/{$user->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Updated Name']);

        $this->assertDatabaseHas('users', ['name' => 'Updated Name']);
    }

    /** @test */
    public function it_can_delete_a_user()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson("/api/users/{$user->id}");

        $response->assertStatus(204);

        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }
}
