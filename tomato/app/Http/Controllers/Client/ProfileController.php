<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Profile\ProfileResource;
use App\Mail\Profile\SubscribeMail;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function personal()
    {
        $posts = auth()->user()->profile->posts;
        $posts = PostResource::collection($posts)->resolve();
        return inertia('Client/Profile/Personal', compact('posts'));
    }

    public function show(Profile $profile)
    {
        $posts = $profile->posts;
        $posts = PostResource::collection($posts)->resolve();
        $profile = ProfileResource::make($profile)->resolve();
        return inertia('Client/Profile/Show', compact('posts', 'profile'));
    }

    public function toggleSubscribe(Profile $profile)
    {
        $res = auth()->user()->profile->subscribings()->toggle($profile->id);
        $is_subscribed = count($res['attached']) > 0;
        Mail::to($profile->user)->send(new SubscribeMail(auth()->user()->profile, $is_subscribed));
        return ProfileResource::make($profile->fresh())->resolve();
    }
}
