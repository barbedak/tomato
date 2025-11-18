<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\IndexRequest;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Post\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

class PostController extends Controller
{
    public function index(IndexRequest $request)
    {
        $data = $request->validated();
//        $posts = PostResource::collection(Post::filter($data)->latest()->get())->resolve(); просто фильтр
        $key = serialize($data);

        $posts = Cache::remember($key, now()->addMinutes(10), function () use ($data) {
            return PostResource::collection(
                Post::filter($data['filter'])->latest()->
                paginate($data['pagination']['per_page'], '*', 'page', $data['pagination']['page'])->onEachSide(2)
            );
        });

        //для асинхронных запросов возвращаем объекты, а не страницу
        if (Request::wantsJson()) {
            return $posts;
        }
        $categories = CategoryResource::collection(Category::all())->resolve();
        return inertia('Admin/Post/Index', compact('posts', 'categories'));
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
        Cache::flush();
        return PostResource::make($post)->resolve();
    }

    public function edit(Post $post)
    {
        $post = PostResource::make($post)->resolve();
        $categories = CategoryResource::collection(Category::all())->resolve();
        Cache::flush();
        return inertia('Admin/Post/Edit', compact('post', 'categories'));
    }

    public function update(Post $post, UpdateRequest $request)
    {
        $data = $request->validated();
        $post = PostService::update($post, $data);
        Cache::flush();
        return inertia('Admin/Post/Show', compact('post'));
    }

    public function destroy(Post $post)
    {
        $post->delete();
        Cache::flush();
        return response()->json([
            'message' => 'Post deleted successfully'
        ], Response::HTTP_OK);
    }
}
