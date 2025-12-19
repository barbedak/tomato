<?php

namespace App\Models;

use App\Models\Traits\hasFilter;
use App\Models\Traits\HasLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string|null $name
 * @property int $user_id
 * @property string|null $gender
 * @property string|null $country
 * @property string|null $birthed_at
 * @property bool|null $is_married
 * @property string|null $avatar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Chat> $chats
 * @property-read int|null $chats_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Group> $groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comment> $likes
 * @property-read int|null $likes_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereBirthedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereIsMarried($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereUserId($value)
 * @mixin \Eloquent
 */
class Profile extends Model
{

    use softDeletes, HasLog, HasFilter;

    public function chats(): BelongsToMany
    {
        return $this->belongsToMany(Chat::class);
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class, 'group_members');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'profile_id')->latest();
    }

    public function likedPosts()
    {
        return $this->morphedByMany(Post::class, 'likeable');
    }

    public function likedComments()
    {
        return $this->morphedByMany(Comment::class, 'likeable');
    }

    public function likedVideos()
    {
        return $this->morphedByMany(Video::class, 'likeable');
    }

    public function viewedPosts()
    {
        return $this->morphedByMany(Post::class, 'viewable');
    }

    public function themes(): HasManyThrough
    {
        return $this->HasManyThrough(Theme::class, Group::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(
            Profile::class,
            'subscriber_subscribing',
            'subscribing_id',
            'subscriber_id'
        );
    }
    public function subscribings(): BelongsToMany
    {
        return $this->belongsToMany(
            Profile::class,
            'subscriber_subscribing',
            'subscriber_id',
            'subscribing_id'
        );
    }

    public function getIsSubscribedAttribute(): bool
    {
        return $this->subscribers->contains('id', auth()->user()->profile->id);
    }

    public function notifications():HasMany
    {
        return $this->hasMany(Notification::class)->whereNull('read_at');
    }

    public function getNotificationsCountAttribute(): int
    {
        return $this->notifications()->count();
    }
}
