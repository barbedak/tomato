<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{
    public static function update(Role $role, array $data): Role
    {
        $role->update($data);
        return $role->refresh();
    }
}
