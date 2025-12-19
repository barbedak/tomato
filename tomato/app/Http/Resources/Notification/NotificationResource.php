<?php

namespace App\Http\Resources\Notification;

use App\Http\Resources\Comment\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'body' => $this->body,
            'id' => $this->id,
            'profile_id' => $this->profile_id,
            //perplexity
            'notifiable' => $this->notifiableResource(),
        ];
    }

    private function notifiableResource()
    {
        $notifiable = $this->notifiable;

        if ($notifiable instanceof \App\Models\Comment) {
            return new CommentResource($notifiable);
        }

        return null;
    }
}
