<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = CommentResource::collection(Comment::all())->resolve();
        return inertia('Client/Comment/Index', compact('comments'));
    }

    public function indexReplies(Comment $comment)
    {
        return CommentResource::collection($comment->replies()->withCount('replies')->get())->resolve();
    }

    public function toggleLike(Comment $comment)
    {
        auth()->user()->profile->likedComments()->toggle($comment->id); //меняем в базе, для актуализации объекта нужно вызвать fresh()
        return CommentResource::make($comment->fresh())->resolve();
    }
}
