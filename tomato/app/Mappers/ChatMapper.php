<?php

namespace App\Mappers;

use App\Http\Resources\Chat\ChatResource;
use App\Http\Resources\Message\MessageResource;
use App\Http\Resources\Profile\ProfileResource;
use App\Models\Chat;

class ChatMapper
{
    public static function show(Chat $chat)
    {
        return [
            'members' => ProfileResource::collection($chat->profiles)->resolve(),
            'messages' => MessageResource::collection($chat->messages)->resolve(),
            'chat' => ChatResource::make($chat)->resolve(),
        ];
    }
}
