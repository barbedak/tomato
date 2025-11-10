<?php

use App\Http\Controllers\Client\CommentController;
use App\Http\Controllers\Client\PostController;
use Illuminate\Support\Facades\Route;

Route::get('posts', [PostController::class, 'index']);
Route::get('comments', [CommentController::class, 'index']);


require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
