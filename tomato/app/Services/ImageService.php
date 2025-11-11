<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Storage;

class ImageService
{
    public static function storeBatch(Post $post, array $data): void
    {
        foreach ($data as $image) {
            $post->images()->create([
                'path' => Storage::disk('public')->put('/images', $image),
            ]);
        }
    }
}
