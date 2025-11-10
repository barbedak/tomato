<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Message\StoreRequest;
use App\Http\Requests\Api\Message\UpdateRequest;
use App\Http\Resources\GroupMessage\GroupMessageResource;
use App\Http\Resources\Message\MessageResource;
use App\Models\Message;
use App\Services\GroupMessageService;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MessageController extends Controller
{
    public function index()
    {
        return MessageResource::collection(Message::all())->resolve();
    }

    public function show(Message $message)
    {
        return MessageResource::make($message)->resolve();
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $groupMessage=GroupMessageService::create($data);
        return GroupMessageResource::make($groupMessage)->resolve();
    }

    public function update(Message $message, UpdateRequest $request)
    {
        $data = $request->validated();
        $message = MessageService::update($message, $data);
        return MessageResource::make($message)->resolve();
    }

    public function destroy(Message $message){
        $message->delete();
        return response(['message' => 'Message destroyed'], Response::HTTP_OK);
    }
}
