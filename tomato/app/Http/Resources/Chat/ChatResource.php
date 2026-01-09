<?php

namespace App\Http\Resources\Chat;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            'title' => $this->title ?? $this->getChatName($this->members),
            'members' => $this->members
        ];
    }

    private function getChatName(string $members): string
    //перенести в аттрибут
    {
        $membersIds = explode('-', $members);
        $companionId = array_diff($membersIds, [auth()->user()->profile->id]);
        $companion = Profile::find(reset($companionId));
        return 'private chat with ' . $companion->name;
    }
}
