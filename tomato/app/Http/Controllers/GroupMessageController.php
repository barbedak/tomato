<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupMessage\GroupMessageResource;
use App\Models\ThemeMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GroupMessageController extends Controller
{
    public function index()
    {
        return GroupMessageResource::collection(ThemeMessage::all())->resolve();
    }

    public function show(ThemeMessage $groupMessage)
    {
        return GroupMessageResource::make($groupMessage)->resolve();
    }

    public function store()
    {
        $groupMessage = ThemeMessage::create([
            'body' => 'Wow body for post from controller',
        ]);
        return $groupMessage;
    }

    public function update(ThemeMessage $groupMessage)
    {
        $groupMessage->update(['body' => 'New body']);
    }

    public function destroy(ThemeMessage $groupMessage){
        $groupMessage->delete();
        return response(['message' => 'ThemeMessage destroyed'], Response::HTTP_OK);
    }
}
