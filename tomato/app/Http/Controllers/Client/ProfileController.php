<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Notification\NotificationResource;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Profile\ProfileResource;
use App\Jobs\Profile\ProfileSubscribeSendMailJob;
use App\Mail\Profile\SubscribeMail;
use App\Models\Chat;
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
        ProfileSubscribeSendMailJob::dispatch($profile, auth()->user()->profile, $is_subscribed);
        return ProfileResource::make($profile->fresh())->resolve();
    }

    public function indexNotification()
    {
        $notifications = NotificationResource::collection(auth()->user()->profile->notifications)->resolve();
        //using notification observer
        return $notifications;
    }

    public function storeChat(Profile $profile)
    {
        $profileAuthUser = auth()->user()->profile;
        $chat = Chat::whereHas('profiles', fn ($q) => $q->where('profile_id', $profile->id))
            ->whereHas('profiles', fn ($q) => $q->where('profile_id', $profileAuthUser->id))
            ->firstOrCreate();
//        $chat = $profile->chatsWithProfile($profileAuthUser)->firstOrCreate();
        $chat->profiles()->syncWithoutDetaching([$profile->id, $profileAuthUser->id]);
        return redirect()->route('client.chats.show', $chat->id);
    }
}
