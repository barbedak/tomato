<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Post\IndexCommentRequest;
use App\Http\Requests\Client\Post\StoreCommentRequest;
use App\Http\Requests\Client\Post\StoreRepostRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Repost\RepostResource;
use App\Mail\Comment\StoreCommentMail;
use App\Mail\Post\ToggleLikeMail;
use App\Models\Post;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

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
        $comments = CommentResource::collection(
            $post->comments()->whereNull('parent_id')->withCount('replies')
                ->paginate(5, '*', 'page', 1)
        );

        $post = PostResource::make($post)->resolve();
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
        $res = auth()->user()->profile->likedPosts()->toggle($post->id); //меняем в базе, для актуализации объекта нужно вызвать fresh()
        $is_liked = count($res['attached']) > 0;
        Mail::to($post->user)->send(new ToggleLikeMail($post, auth()->user()->profile, $is_liked));
        return PostResource::make($post->fresh())->resolve();
    }

    public function storeComment(Post $post, StoreCommentRequest $request)
    {
        $data = $request->validated();
        $comment = $post->comments()->create($data);
        Mail::to($post->user)->send(new StoreCommentMail($post, $comment));
        return CommentResource::make($comment)->resolve();
    }

    public function indexComment(Post $post, IndexCommentRequest $request)
    {
//        $comments=CommentResource::collection($post->comments)->resolve(); //->resolve() возвращает массив
        $data = $request->validationData();
        $comments = $post->comments()->whereNull('parent_id')->withCount('replies');
        return CommentResource::collection(
            $comments->paginate(5, '*', 'page', $data['page'])
        );
    }

    public function storeRepost(Post $post, StoreRepostRequest $request)
    {
        $data = $request->validated();
        $repost = $post->reposts()->create($data);
        Mail::to($post->user)->send(new StoreRepostMail($post, $repost));
        return PostResource::make($post)->resolve();
    }
}
