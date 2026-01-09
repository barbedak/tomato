<?php

use App\Http\Controllers\Client\ChatController;
use App\Http\Controllers\Client\CommentController;
use App\Http\Controllers\Client\FeedController;
use App\Http\Controllers\Client\PostController;
use App\Http\Controllers\Client\ProfileController;

Route::group(['prefix' => 'client', 'middleware' => ['auth'], 'as' => 'client.'], function () {
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('posts/{post}/likes', [PostController::class, 'toggleLike'])->name('posts.likes.toggle');
    Route::post('posts/{post}/comments', [PostController::class, 'storeComment'])->name('posts.comments.store');
    Route::get('posts/{post}/comments', [PostController::class, 'indexComment'])->name('posts.comments.index');
    Route::post('posts/{post}/reposts', [PostController::class, 'storeRepost'])->name('posts.reposts.store');

    Route::get('feed', [FeedController::class, 'index'])->name('feed.index');

    Route::get('profiles', [ProfileController::class, 'index'])->name('profiles.index');
    Route::get('profiles/personal', [ProfileController::class, 'personal'])->name('profiles.personal');
    Route::post('profiles/{profile}/subscribes', [ProfileController::class, 'toggleSubscribe'])->name('profiles.subscribes.toggle');
    Route::post('profiles/{profile}/chats', [ProfileController::class, 'storeChat'])->name('profiles.chats.store');
    Route::get('profiles/notifications', [ProfileController::class, 'indexNotification'])->name('profiles.notifications.index');
    Route::get('profiles/{profile}', [ProfileController::class, 'show'])->name('profiles.show');

    Route::get('chats', [ChatController::class, 'index'])->name('chats.index');
    Route::post('chats', [ChatController::class, 'store'])->name('chats.store');
    Route::get('chats/{chat}', [ChatController::class, 'show'])->name('chats.show');
    Route::post('chats/{chat}/message', [ChatController::class, 'storeMessage'])->name('chats.messages.store');

    Route::post('comments/{comment}/likes', [CommentController::class, 'toggleLike'])->name('comments.likes.toggle');
    Route::get('comments/{comment}/replies', [CommentController::class, 'indexReplies'])->name('comments.replies.index');

});


