<?php

namespace App\Observers;

use App\Events\Log\LogFinishRecordEvent;
use App\Events\Log\LogStartRecordEvent;
use App\Models\Post;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        LogStartRecordEvent::dispatch($post, 'created');
        $post->log()->create([
            'action' => 'created',
            'attributes' => json_encode($post->attributesToArray())
        ]);
        LogFinishRecordEvent::dispatch($post, 'created');
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        LogStartRecordEvent::dispatch($post, 'updated');
        $attr = $post->getRawOriginal();
        $new_attr = $post->getDirty();
        $post->log()->create([
            'action' => 'updated',
            'new_attributes' => json_encode($new_attr),
            'attributes' => json_encode($attr)
        ]);
        LogFinishRecordEvent::dispatch($post, 'updated');
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        LogStartRecordEvent::dispatch($post, 'deleted');
        $post->log()->create([
            'action' => 'deleted',
            'attributes' => json_encode($post->attributesToArray())
        ]);
        LogFinishRecordEvent::dispatch($post, 'deleted');
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function retrieved(Post $post): void
    {
        LogStartRecordEvent::dispatch($post, 'retrieved');
        $post->log()->create([
            'action' => 'retrieved',
            'attributes' => json_encode($post->attributesToArray())
        ]);
        LogFinishRecordEvent::dispatch($post, 'retrieved');
    }
}
