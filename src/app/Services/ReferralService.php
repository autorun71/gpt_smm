<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class ReferralService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createReferralLink(User $user, string $link)
    {
        // Logic for creating and saving referral link
        $user->referral_link = $link;
        $this->userRepository\save($user);
    }

    public function updateReferralBalance(User $user, float $amount)
    {
        $user->referral_balance += $amount;
        $this->userRepository\save($user);
    }

    public function deleteReferralLink(User $user)
    {
        $user->referral_link = null;
        $this->userRepository\save($user);
    }
}
