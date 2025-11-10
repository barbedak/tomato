<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function getPosts(){
        $res = Http::get('http://127.0.0.1:8000/api/posts');
        foreach ($res->collect() as $item) {
            Post::firstOrCreate([
                'title' => $item['title'],
            ]);
        }
    }
}
