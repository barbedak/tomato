<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    public static function update(Tag $tag, array $data): Tag
    {
        $tag->update($data);
        return $tag->refresh();
    }

    public static function storeBatch(array $tagsArr): array
    {
        $tags = [];
        foreach ($tagsArr as $tagTitle) {
            $tags[] = Tag::firstOrCreate([
                'title' => $tagTitle
            ]);
        }
        return $tags;
    }
}
