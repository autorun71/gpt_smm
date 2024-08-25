<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    protected function getModelInstance()
    {
        return new User();
    }
}
