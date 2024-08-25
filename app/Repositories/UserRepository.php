<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function findById($id)
    {
        return User::find($id);
    }

    public function save(User $user)
    {
        $user->save();
    }

    public function delete(User $user)
    {
        $user->delete();
    }
}
