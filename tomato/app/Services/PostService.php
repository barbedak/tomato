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
            $images = array();
            if (array_key_exists('images', $data['post'])) {
                $images = $data['post']['images'];
            }
            unset($data['post']['images']);

            $post = Post::create($data['post']);

            $tagsArr = explode(',', $data['tags']);
            $tags = TagService::storeBatch($tagsArr);
            $post->tags()->attach(array_column($tags, 'id'));

            foreach ($images as $file) {
                $path = Storage::disk('public')->put('/images', $file);
                $post->image()->create([
                    'path' => $path,
                ]);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }


        return $post;
    }

    public static function update(Post $post, array $data): Post
    {
        try {
            DB::beginTransaction();
            $images = array();
            if (array_key_exists('images', $data['post'])) {
                $images = $data['post']['images'];
            }
            unset($data['post']['images']);

            $post->update($data['post']);

            $tagsArr = explode(',', $data['tags']);
            $tags = TagService::storeBatch($tagsArr);

            $post->tags()->sync(array_column($tags, 'id'));// неправильно

            foreach ($images as $file) {
                $path = Storage::disk('public')->put('/images', $file);
                $post->image()->create([
                    'path' => $path,
                ]);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }
        return $post->refresh();
    }
}
