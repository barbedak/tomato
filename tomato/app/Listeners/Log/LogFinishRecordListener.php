<?php

namespace App\Listeners\Log;

use App\Events\Log\LogFinishRecordEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogFinishRecordListener
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
    public function handle(LogFinishRecordEvent $event): void
    {
        $modelClass = get_class($event->model);
        dump("Finish record $event->action $modelClass to log");
    }
}
