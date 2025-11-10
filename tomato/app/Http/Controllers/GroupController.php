<?php

namespace App\Http\Controllers;

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

    public function store()
    {
        $group = Group::create([
            'title' => 'Wow title for post from controller',
        ]);
        return $group;
    }

    public function update(Group $group)
    {
        $group->update(['title' => 'New Title']);
    }

    public function destroy(Group $group){
        $group->delete();
        return response(['message' => 'Group destroyed'], Response::HTTP_OK);
    }
}
