<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Post\ShowPostRequest;
use App\Http\Requests\Client\Post\StoreCommentRequest;
use App\Http\Resources\Comment\CommentResource;
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

    public function show(Post $post, ShowPostRequest $request)
    {
//        $comments=CommentResource::collection($post->comments)->resolve(); //->resolve() возвращает массив
        $data = $request->validationData();
        $comments = CommentResource::collection(
            $post->comments()->paginate(5, '*', 'page', $data['page'])
        );

//        $post = $post->toResource();
//        или

        $post = PostResource::make($post)->resolve();
        if ($request->wantsJson()) {
            return $comments;
        }
        return inertia('Client/Post/Show', compact('post', 'comments'));
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

    public function storeComment(Post $post, StoreCommentRequest $request)
    {
        $data = $request->validated();
        $comment = $post->comments()->create($data);
        return CommentResource::make($comment)->resolve();
    }
}
