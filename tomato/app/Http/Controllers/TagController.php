<?php

namespace App\Http\Controllers;

use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TagController extends Controller
{
    public function index()
    {
        return TagResource::collection(Tag::all())->resolve();
    }

    public function show(Tag $tag)
    {
        return TagResource::make($tag)->resolve();
    }

    public function store()
    {
        $tag = Tag::create([
            'title' => 'Wow title for tag from controller',
        ]);
        return $tag;
    }

    public function update(Tag $tag)
    {
        $tag->update(['title' => 'New Title']);
    }

    public function destroy(Tag $tag){
        $tag->delete();
        return response(['message' => 'Tag destroyed'], Response::HTTP_OK);
    }
}
