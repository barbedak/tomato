<?php

namespace App\Jobs\Comment;

use App\Mail\Comment\StoreCommentMail;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class CommentStoreSendMailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private Post $post, private Comment $comment)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->post->user)->send(new StoreCommentMail($this->post, $this->comment));
    }
}
