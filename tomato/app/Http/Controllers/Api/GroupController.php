<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Group\StoreRequest;
use App\Http\Requests\Api\Group\UpdateRequest;
use App\Http\Resources\Group\GroupResource;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GroupController extends Controller
{
    public function index()
    {
        return GroupResource::collection(Group::all())->resolve();
    }

    public function show(Group $group)
    {
        return GroupResource::make($group)->resolve();
    }

    public function store(StoreRequest $request)
    {
        $data = $request -> validated();
        $group = Group::create($data);
        return GroupResource::make($group)->resolve();
    }

    public function update(Group $group, UpdateRequest $request)
    {
        $data = $request -> validated();
        $group->update($data);
        return GroupResource::make($group)->resolve();
    }

    public function destroy(Group $group){
        $group->delete();
        return response(['message' => 'Group destroyed'], Response::HTTP_OK);
    }
}
