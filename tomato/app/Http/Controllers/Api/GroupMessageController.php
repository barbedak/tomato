<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GroupMessage\StoreRequest;
use App\Http\Requests\Api\GroupMessage\UpdateRequest;
use App\Http\Resources\GroupMessage\GroupMessageResource;
use App\Models\ThemeMessage;
use App\Services\GroupMessageService;
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

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $groupMessage = ThemeMessage::create($data);
        return GroupMessageResource::make($groupMessage)->resolve();
    }

    public function update(ThemeMessage $groupMessage, UpdateRequest $request)
    {
        $data = $request->validated();
        $groupMessage=GroupMessageService::update($groupMessage, $data);
        return GroupMessageResource::make($groupMessage)->resolve();
    }

    public function destroy(ThemeMessage $groupMessage){
        $groupMessage->delete();
        return response(['message' => 'ThemeMessage destroyed'], Response::HTTP_OK);
    }
}
