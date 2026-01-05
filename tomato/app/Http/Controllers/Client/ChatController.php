<?php

namespace App\Http\Controllers\Client;

use App\Events\WS\SendMessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Chat\StoreMessageRequest;
use App\Http\Resources\Chat\ChatResource;
use App\Http\Resources\Message\MessageResource;
use App\Http\Resources\Profile\ProfileResource;
use App\Mappers\ChatMapper;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function show(Chat $chat)
    {
        $data = ChatMapper::show($chat);
        return inertia('Client/Chat/Show', $data);
    }

    public function storeMessage(Chat $chat, StoreMessageRequest $request)
    {
        $data = $request->validated();
        $message = $chat->messages()->create($data);
        broadcast(new SendMessageEvent($message))->toOthers();
        return MessageResource::make($message)->resolve();
    }
}
