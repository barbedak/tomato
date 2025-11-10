<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\PostException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\IndexRequest;
use App\Http\Requests\Api\Post\StoreRequest;
use App\Http\Requests\Api\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function index(IndexRequest $request)
    {
        $data = $request->validated();
        $posts = Post::filter($data)->get();
        return PostResource::collection($posts)->resolve();
    }

    public function show(Post $post)
    {
        $post = Post::firstOrCreate(['title'=> '! Gryphon hastily.'], [
            'profile_id' => 1
        ]);
        PostException::isAlreadyExists($post);
        return PostResource::make($post)->resolve();
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $post = Post::create($data);
        return PostResource::make($post)->resolve();
    }

    public function update(Post $post, UpdateRequest $request)
    {
        $data = $request->validated();
        $post = PostService::update($post, $data);
        return PostResource::make($post)->resolve();
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response(['message' => 'Post destroyed'], Response::HTTP_OK);
    }
}
