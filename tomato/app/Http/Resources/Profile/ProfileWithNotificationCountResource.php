<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileWithNotificationCountResource extends JsonResource
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
            'user_id' => $this->user_id,
            'name' => $this->name,
            'gender' => $this->gender,
            'country' => $this->country,
            'is_married' => $this->is_married,
            'birthed_at' => $this->birthed_at,
            'avatar' => $this->avatar,
            'is_subscribed' => $this->isSubscribed,
            'notifications_count' => $this->notifications_count
        ];
    }
}
