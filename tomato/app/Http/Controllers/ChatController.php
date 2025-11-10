<?php

namespace App\Http\Controllers;

use App\Http\Resources\Chat\ChatResource;
use App\Models\Chat;
use Illuminate\Http\Response;

class ChatController extends Controller
{
    public function index()
    {
        return ChatResource::collection(Chat::all())->resolve();
    }

    public function show(Chat $chat)
    {
        return ChatResource::make($chat)->resolve();
    }

    public function store()
    {
        $chat = Chat::create([
            'title' => 'Wow title for Chat from controller',
        ]);
        return $chat;
    }

    public function update(Chat $chat)
    {
        $chat->update(['title' => 'New Title']);
    }

    public function destroy(Chat $chat){
        $chat->delete();
        return response(['message' => 'Chat destroyed'], Response::HTTP_OK);
    }
}
