<?php

namespace App\Listeners\User;

use App\Events\User\StoredUserEvent;

class StoreLogListeger
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StoredUserEvent $event): void
    {
        $event->user->profile()->firstOrCreate(['name' => $event->user->name]);
    }
}
