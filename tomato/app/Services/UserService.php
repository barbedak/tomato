<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public static function update(User $user, array $data): User
    {
        $user->update($data);
        return $user->refresh();
    }
}
