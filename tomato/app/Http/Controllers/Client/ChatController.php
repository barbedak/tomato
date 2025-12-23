<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Chat\ChatResource;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function show(Chat $chat)
    {
        $chat = ChatResource::make($chat)->resolve();
        return inertia('Client/Chat/Show', compact('chat'));
    }
}
