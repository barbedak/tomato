<?php

use App\Http\Controllers\Client\CommentController;
use App\Http\Controllers\Client\FeedController;
use App\Http\Controllers\Client\PostController;
use App\Http\Controllers\Client\ProfileController;

Route::group(['prefix' => 'client', 'middleware' => 'auth'], function () {
    Route::get('posts', [PostController::class, 'index'])->name('client.posts.index');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('client.posts.show');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('client.posts.destroy');
    Route::post('posts/{post}/likes', [PostController::class, 'toggleLike'])->name('client.posts.likes.toggle');
    Route::post('posts/{post}/comments', [PostController::class, 'storeComment'])->name('client.posts.comments.store');
    Route::get('posts/{post}/comments', [PostController::class, 'indexComment'])->name('client.posts.comments.index');
    Route::post('posts/{post}/reposts', [PostController::class, 'storeRepost'])->name('client.posts.reposts.store');

    Route::get('feed', [FeedController::class, 'index'])->name('client.feed.index');
    Route::get('profiles/personal', [ProfileController::class, 'personal'])->name('client.profiles.personal');
    Route::post('profiles/{profile}/subscribes', [ProfileController::class, 'toggleSubscribe'])->name('client.profiles.subscribes.toggle');
    Route::get('profiles/{profile}', [ProfileController::class, 'show'])->name('client.profiles.show');
    Route::post('comments/{comment}/likes', [CommentController::class, 'toggleLike'])->name('client.comments.likes.toggle');
    Route::get('comments/{comment}/replies', [CommentController::class, 'indexReplies'])->name('client.comments.replies.index');

});


