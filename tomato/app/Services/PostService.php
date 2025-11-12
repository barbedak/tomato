<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Storage;

class PostService
{
    public static function store(array $data): Post
    {
        try {
            DB::beginTransaction();

            $post = Post::create($data['post']);
            ImageService::storeBatch($post, $data['images']);
            $tagsArr = explode(',', $data['tags']);
            $tags = TagService::storeBatch($tagsArr);
            $post->tags()->attach(array_column($tags, 'id'));

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }


        return $post;
    }

    public static function update(Post $post, array $data): Post
    {
        try {
            DB::beginTransaction();
            $post->update($data['post']);
            if (array_key_exists('images', $data)) {
                ImageService::storeBatch($post, $data['images']);
            }


            $tagsArr = explode(',', $data['tags']);
            $tags = TagService::storeBatch($tagsArr);

            $post->tags()->sync(array_column($tags, 'id'));


            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        return $post->refresh();
    }
}
