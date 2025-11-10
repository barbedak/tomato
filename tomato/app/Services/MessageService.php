<?php

namespace App\Services;

use App\Models\Message;

class MessageService
{
    public static function update(Message $message, array $data): Message
    {
        $message->update($data);
        return $message->refresh();
    }
}
