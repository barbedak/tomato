<?php

namespace App\Jobs\Post;

use App\Mail\Post\ToggleLikeMail;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class PostToggelLikeSendMailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private Post $post, private Profile $profile, private bool $is_liked)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->post->user)->send(new ToggleLikeMail($this->post, $this->profile, $this->is_liked));
    }
}
