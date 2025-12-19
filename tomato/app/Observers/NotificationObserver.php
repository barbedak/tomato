<?php

namespace App\Observers;

use App\Models\Notification;

class NotificationObserver
{
    public function retrieved(Notification $notification): void
    {
        //auth()->user()?
        $notification->update(['read_at' => now()->format('Y-m-d H:i:s')]);
    }
}
