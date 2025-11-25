<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function personal()
    {
        $posts = auth()->user()->profile->posts;
        $posts = PostResource::collection($posts)->resolve();
        return inertia('Client/Profile/Personal', compact('posts'));
    }
}
