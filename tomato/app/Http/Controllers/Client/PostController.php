<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function index()
    {
        $posts = PostResource::collection(Post::all())->resolve();
        return inertia('Client/Post/Index', compact('posts'));
    }

    public function show(Post $post)
    {
//        $post = $post->toResource();
//        или
        $post = PostResource::make($post)->resolve();
        return inertia('Client/Post/Show', compact('post'));
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            'message' => 'Post deleted successfully'
        ], Response::HTTP_OK);
    }
    public function toggleLike(Post $post)
    {
        auth()->user()->profile->likedPosts()->toggle($post->id); //меняем в базе, для актуализации объекта нужно вызвать fresh()
        return PostResource::make($post->fresh())->resolve();
    }
}
