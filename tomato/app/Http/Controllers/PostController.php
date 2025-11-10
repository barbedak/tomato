<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::all())->resolve();
    }

    public function show(Post $post)
    {
        return PostResource::make($post)->resolve();
    }

    public function store()
    {
        $post = Post::create([
            'title' => 'Wow title for post from controller',
        ]);
        return $post;
    }

    public function update(Post $post)
    {
        $post->update(['title' => 'New Title']);
    }

    public function destroy(Post $post){
        $post->delete();
        return response(['message' => 'Post destroyed'], Response::HTTP_OK);
    }
}
