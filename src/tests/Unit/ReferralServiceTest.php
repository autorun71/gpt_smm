<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\ReferralService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReferralServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $userRepository;
    protected $referralService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepository = new UserRepository();
        $this->referralService = new ReferralService($this->userRepository);
    }

    /** @test */
    public function it_can_create_a_referral_link()
    {
        $user = User::factory()->create();

        $this->referralService\createReferralLink($user, 'http://example.com/referral');

        $this->assertEquals('http://example.com/referral', $user->referral_link);
    }

    /** @test */
    public function it_can_update_referral_balance()
    {
        $user = User::factory()->create(['referral_balance' => 0]);

        $this->referralService\updateReferralBalance($user, 50.00);

        $this->assertEquals(50.00, $user->referral_balance);
    }

    /** @test */
    public function it_can_delete_a_referral_link()
    {
        $user = User::factory()->create(['referral_link' => 'http://example.com/referral']);

        $this->referralService\deleteReferralLink($user);

        $this->assertNull($user->referral_link);
    }
}
