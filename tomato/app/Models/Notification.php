<?php

namespace App\Models;

use App\Observers\NotificationObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(NotificationObserver::class)]
class Notification extends Model
{
    protected $guarded = false;

    public function notifiable()
    {
        return $this->morphTo();
    }
}
