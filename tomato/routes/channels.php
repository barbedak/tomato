<?php

use Illuminate\Support\Facades\Broadcast;

//Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//    return (int) $user->id === (int) $id;
//});
Broadcast::channel('chats.{id}.messages.store', function ($user, $id) {
    return (bool) $user->profile->chats->contains($id);
});

Broadcast::channel('notifications.{id}', function ($user, $id) {
        return (bool) $user->profile->id == (int) $id;
});
