<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\StoreRequest;
use App\Http\Resources\Role\RoleResource;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = RoleResource::collection(Role::all())->resolve();
        return inertia('Admin/Role/Index', compact('roles'));
    }

    public function show(Role $role)
    {
        $role = RoleResource::make($role)->resolve();
        return inertia('Admin/Role/Show', compact('role'));
    }

    public function create()
    {
        return inertia('Admin/Role/Create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $role = Role::create($data);
        return RoleResource::make($role)->resolve();
    }
}
