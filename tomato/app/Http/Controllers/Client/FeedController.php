<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FeedController extends Controller
{
    public function index()
    {
        $posts = PostResource::collection(Post::all())->resolve();
        return inertia('Client/Feed/Index', compact('posts'));
    }
}
