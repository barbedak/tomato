<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\GroupMessageController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\VideoController;
use App\Http\Middleware\AccessPostMiddleware;
use App\Http\Middleware\AccessVideoMiddleware;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [AuthController::class, 'login']);
Route::group(['middleware' => 'jwt.auth', 'prefix' => 'auth'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});


Route::group(['middleware' => ['jwt.auth', AccessPostMiddleware::class]], function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::patch('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

Route::group(['middleware' => ['jwt.auth', AccessVideoMiddleware::class]], function () {
    Route::apiResource('videos', VideoController::class);
});

Route::apiResource('profiles', ProfileController::class);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::patch('/categories/{category}', [CategoryController::class, 'update']);
Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

Route::get('/comments', [CommentController::class, 'index']);
Route::get('/comments/{comment}', [CommentController::class, 'show']);
Route::post('/comments', [CommentController::class, 'store']);
Route::patch('/comments/{comment}', [CommentController::class, 'update']);
Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);

Route::get('/chats', [ChatController::class, 'index']);
Route::get('/chats/{chat}', [ChatController::class, 'show']);
Route::post('/chats', [ChatController::class, 'store']);
Route::patch('/chats/{chat}', [ChatController::class, 'update']);
Route::delete('/chats/{chat}', [ChatController::class, 'destroy']);

Route::get('/groups', [GroupController::class, 'index']);
Route::get('/groups/{group}', [GroupController::class, 'show']);
Route::post('/groups', [GroupController::class, 'store']);
Route::patch('/groups/{group}', [GroupController::class, 'update']);
Route::delete('/groups/{group}', [GroupController::class, 'destroy']);

Route::get('/group_messages', [GroupMessageController::class, 'index']);
Route::get('/group_messages/{groupMessage}', [GroupMessageController::class, 'show']);
Route::post('/group_messages', [GroupMessageController::class, 'store']);
Route::patch('/group_messages/{groupMessage}', [GroupMessageController::class, 'update']);
Route::delete('/group_messages/{groupMessage}', [GroupMessageController::class, 'destroy']);

Route::get('/messages', [MessageController::class, 'index']);
Route::get('/messages/{message}', [MessageController::class, 'show']);
Route::post('/messages', [MessageController::class, 'store']);
Route::patch('/messages/{message}', [MessageController::class, 'update']);
Route::delete('/messages/{message}', [MessageController::class, 'destroy']);
