<?php

namespace App\Services;

use App\Models\Group;

class GroupService
{
    public static function update(Group $group, array $data): Group
    {
        $group->update($data);
        return $group->refresh();
    }
}
