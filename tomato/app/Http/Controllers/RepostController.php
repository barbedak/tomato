<?php

namespace App\Http\Controllers;

use App\Http\Resources\Repost\RepostResource;
use App\Models\Repost;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RepostController extends Controller
{
    public function index()
    {
        return RepostResource::collection(Repost::all())->resolve();
    }

    public function show(Repost $repost)
    {
        return RepostResource::make($repost)->resolve();
    }

    public function store()
    {
        $repost = Repost::create([
            'parent' => 'Wow parent for repost from controller',
        ]);
        return $repost;
    }

    public function update(Repost $repost)
    {
        $repost->update(['parent' => 'New Parent']);
    }

    public function destroy(Repost $repost){
        $repost->delete();
        return response(['message' => 'Repost destroyed'], Response::HTTP_OK);
    }
}
