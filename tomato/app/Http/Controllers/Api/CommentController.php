<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Comment\IndexRequest;
use App\Http\Requests\Api\Comment\StoreRequest;
use App\Http\Requests\Api\Comment\UpdateRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(IndexRequest $request)
    {
        $data = $request->validated();
        $comments = Comment::filter($data)->get();
        return CommentResource::collection($comments)->resolve();
    }

    public function show(Comment $comment)
    {
        return CommentResource::make($comment)->resolve();
    }

    public function store(StoreRequest $request)
    {
        $data = $request ->validated();
        $comment = Comment::create($data);

        return CommentResource::make($comment)->resolve();
    }

    public function update(Comment $comment, UpdateRequest $request)
    {
        $data = $request ->validated();
        $comment = CommentService::update($comment, $data);
        return CommentResource::make($comment)->resolve();
    }

    public function destroy(Comment $comment){
        $comment->delete();
        return response(['message' => 'Comment destroyed'], Response::HTTP_OK);
    }
}
