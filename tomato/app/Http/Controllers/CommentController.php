<?php

namespace App\Http\Controllers;

use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function index()
    {
        return CommentResource::collection(Comment::all())->resolve();
    }

    public function show(Comment $comment)
    {
        return CommentResource::make($comment)->resolve();
    }

    public function store()
    {
        $comment = Comment::create([
            'title' => 'Wow title for post from controller',
        ]);
        return $comment;
    }

    public function update(Comment $comment)
    {
        $comment->update(['title' => 'New Title']);
    }

    public function destroy(Comment $comment){
        $comment->delete();
        return response(['message' => 'Comment destroyed'], Response::HTTP_OK);
    }
}
