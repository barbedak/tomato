<?php

namespace App\Services;

use App\Models\ThemeMessage;

class GroupMessageService
{
    public static function update(ThemeMessage $groupMessage, array $data): ThemeMessage
    {
        $groupMessage->update($data);
        return $groupMessage->refresh();
    }
}
