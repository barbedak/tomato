<?php

namespace App\Services;

use App\Models\Chat;

class ChatService
{
    public static function update(Chat $chat, array $data): Chat
    {
        $chat->update($data);
        return $chat->refresh();
    }
}
