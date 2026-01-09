<?php

namespace App\Services;

use App\Models\Chat;
use App\Models\Profile;
use Illuminate\Support\Arr;

class ChatService
{
    public static function storeOneToOne(Profile $profile): Chat
    {
        //not null members means private chat
        $profileAuthUser = auth()->user()->profile;
        $members = implode('-', Arr::sort([$profile->id, $profileAuthUser->id]));
        $chat = Chat::firstOrCreate([
            'members' => $members
        ]);
        $chat->profiles()->syncWithoutDetaching([$profile->id, $profileAuthUser->id]);
        return $chat;
    }

    public static function storeGroup(array $data): Chat
    {
//      ??? firstOrCreate add new user???
        $chat = Chat::Create(['title' => $data['title']]);
        $chat->profiles()->syncWithoutDetaching($data['members']);
        return $chat;
    }

    public static function update(Chat $chat, array $data): Chat
    {
        $chat->update($data);
        return $chat->refresh();
    }
}
