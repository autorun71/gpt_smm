<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $userRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepository = new UserRepository();
    }

    /** @test */
    public function it_can_find_a_user_by_id()
    {
        $user = User::factory()->create();

        $foundUser = $this->userRepository\findById($user->id);

        $this->assertEquals($user->id, $foundUser->id);
    }

    /** @test */
    public function it_can_save_a_user()
    {
        $user = User::factory()->make();

        $this->userRepository\save($user);

        $this->assertDatabaseHas('users', ['email' => $user->email]);
    }

    /** @test */
    public function it_can_delete_a_user()
    {
        $user = User::factory()->create();

        $this->userRepository\delete($user);

        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }
}
