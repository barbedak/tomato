<?php

namespace App\Services;

use App\Models\Repost;

class RepostService
{
    public static function update(Repost $repost, array $data): Repost
    {
        $repost->update($data);
        return $repost->refresh();
    }
}
