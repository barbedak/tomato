<?php

namespace App\Observers;

use App\Models\Notification;

class NotificationObserver
{
    public function retrieved(): void
    {
        //auth()->user()?
        auth()->user()?->profile->notifications()->update(['read_at' => now()->format('Y-m-d H:i:s')]);
    }
}
