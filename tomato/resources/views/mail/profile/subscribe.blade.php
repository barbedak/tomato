<div>
    @if ($is_liked)
        <div> User {{ $profile->name }} subscribed on you</div>
    @else
        <div> User {{ $profile->name }} unsubscribed from you</div>
    @endif
</div>
