<?php

namespace App\Http\Resources\Comment;

use App\Http\Resources\Post\PostResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'parent_id' => $this->parent_id,
            'name' => $this->name,
            'formatted_date' => $this->formatted_date,
            'is_liked' => $this->is_liked,
            'replies_count' => $this->replies_count,
            'liked_by_profiles_count' => $this->liked_by_profiles_count,
            'commentable' => $this->commentableResource(),
        ];
    }
    private function commentableResource()
    {
        $commentable = $this->commentable;

        if ($commentable instanceof \App\Models\Post) {
            return new PostResource($commentable);
        }

        return null;
    }
}
