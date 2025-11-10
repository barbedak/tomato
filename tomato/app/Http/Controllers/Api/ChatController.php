<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Chat\StoreRequest;
use App\Http\Requests\Api\Chat\UpdateRequest;
use App\Http\Resources\Chat\ChatResource;
use App\Models\Chat;
use App\Services\ChatService;
use Illuminate\Http\Request;
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

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $chat = Chat::create($data);
        return ChatResource::make($chat)->resolve();
    }

    public function update(Chat $chat, UpdateRequest $request)
    {
        $data = $request->validated();
        $chat = ChatService::update($chat, $data);
        return ChatResource::make($chat)->resolve();
    }

    public function destroy(Chat $chat)
    {
        $chat->delete();
        return response(['message' => 'Chat destroyed'], Response::HTTP_OK);
    }
}
