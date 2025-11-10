<?php

namespace App\Http\Controllers;

use App\Http\Resources\Role\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    public function index()
    {
        return RoleResource::collection(Role::all())->resolve();
    }

    public function show(Role $role)
    {
        return RoleResource::make($role)->resolve();
    }

    public function store()
    {
        $role = Role::create([
            'title' => 'Wow title for role from controller',
        ]);
        return $role;
    }

    public function update(Role $role)
    {
        $role->update(['title' => 'New Title']);
    }

    public function destroy(Role $role){
        $role->delete();
        return response(['message' => 'Role destroyed'], Response::HTTP_OK);
    }
}
