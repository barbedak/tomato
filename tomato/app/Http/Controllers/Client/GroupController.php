<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Group\StoreRequest;
use App\Http\Resources\Group\GroupResource;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = GroupResource::collection(auth()->user()->profile->groups)->resolve();
        return inertia('Client/Group/Index', compact('groups'));
    }

    public function show(Group $group)
    {
        $group = GroupResource::make($group)->resolve();
        return inertia('Client/Group/Show', compact('group'));
    }

    public function create()
    {
        return inertia('Client/Group/Create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $group = Group::create($data);
        $group = GroupResource::make($group)->resolve();
        return redirect()->route('client.groups.show', $group->id);
    }

    public function toggleProfiles(Group $group)
    {
        auth()->user()->profile->groups()->toggle($group->id);
        return GroupResource::make($group->fresh())->resolve();
    }
}
