<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Post\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Storage;

class PostController extends Controller
{
    public function index()
    {
//        $posts = PostResource::collection(Post::all())->resolve();
        $posts = PostResource::collection(Post::latest()->get())->resolve();
        return inertia('Admin/Post/Index', compact('posts'));
    }

    public function show(Post $post)
    {
//        $post = $post->toResource();
//        или
        $post = PostResource::make($post)->resolve();
        return inertia('Admin/Post/Show', compact('post'));
    }

    public function create()
    {
//        $categories = Category::all();
//        $categories = $categories->toResourceCollection();
//        альтернатива нижеследующему
        $categories = CategoryResource::collection(Category::all())->resolve();
        return inertia('Admin/Post/Create', compact('categories'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
//        $data = $request->validated();
        $post = PostService::store($data);
        return PostResource::make($post)->resolve();
    }

    public function edit(Post $post)
    {
        $post = PostResource::make($post)->resolve();
        $categories = CategoryResource::collection(Category::all())->resolve();
        return inertia('Admin/Post/Edit', compact('post', 'categories'));
    }

    public function update(Post $post, UpdateRequest $request)
    {
        $data = $request->validated();
        $post = PostService::update($post, $data);
        return inertia('Admin/Post/Show', compact('post'));
    }
}
