<?php

namespace App\Jobs\Profile;

use App\Mail\Profile\SubscribeMail;
use App\Models\Profile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Boolean;

class ProfileSubscribeSendMailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private Profile $profile, private Profile $subsciber, private bool $is_subscribed)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->profile->user)->send(new SubscribeMail($this->subsciber, $this->is_subscribed));
    }
}
