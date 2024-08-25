<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_user()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'),
        ];

        $user = User::create($data);

        $this->assertDatabaseHas('users', ['email' => 'testuser@example.com']);
    }

    /** @test */
    public function it_can_update_a_user()
    {
        $user = User::factory()->create();

        $user->update(['name' => 'Updated Name']);

        $this->assertDatabaseHas('users', ['name' => 'Updated Name']);
    }

    /** @test */
    public function it_can_delete_a_user()
    {
        $user = User::factory()->create();

        $user->delete();

        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }
}
