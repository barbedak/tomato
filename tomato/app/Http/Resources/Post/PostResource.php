<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Tag\TagResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        dd(ImageResource::collection($this->images)->resolve());
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'profile_id' => $this->profile_id,
            'parent_id' => $this->parent_id,
            'body' => $this->body,
            'published_at' => $this->published_at,
            'image_path' => $this->image_path,
            'views' => $this->views,
            'is_published' => $this->is_published,
            'status' => $this->status,
            'profile_name' => $this->profile->name,
            'comments' => $this->comments,
//            'img_url' => $this->img_url,
            'images' => ImageResource::collection($this->images)->resolve(),
            'tags' => $this->tags_as_string,
            'is_liked' => $this->is_liked,
            'liked_by_profiles_count' => $this->liked_by_profiles_count,
            'reposts_count' => $this->reposts_count,
            'parent' => $this->parent

        ];
    }
}
