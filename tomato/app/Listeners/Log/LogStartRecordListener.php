<?php

namespace App\Listeners\Log;

use App\Events\Log\LogStartRecordEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogStartRecordListener
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
    public function handle(LogStartRecordEvent $event): void
    {
        $modelClass = get_class($event->model);
        dump("Start record $event->action $modelClass to log");
    }
}
