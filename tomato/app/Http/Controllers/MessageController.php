<?php

namespace App\Http\Controllers;

use App\Http\Resources\Message\MessageResource;
use App\Models\Message;
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

    public function store()
    {
        $message = Message::create([
            'body' => 'Wow body for message from controller',
        ]);
        return $message;
    }

    public function update(Message $message)
    {
        $message->update(['body' => 'New body']);
    }

    public function destroy(Message $message){
        $message->delete();
        return response(['message' => 'Message destroyed'], Response::HTTP_OK);
    }
}
