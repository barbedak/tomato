<?php

namespace App\Models;

use App\Models\Traits\hasFilter;
use App\Models\Traits\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $body
 * @property int $profile_id
 * @property int $post_id
 * @property int|null $parent_id
 * @property int|null $likes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Profile> $likers
 * @property-read int|null $likers_count
 * @property-read Comment|null $parent
 * @property-read \App\Models\Post $post
 * @property-read \App\Models\Profile $profile
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{
    use HasFactory, SoftDeletes, HasLog, HasFilter;

    protected $guarded = false;
    protected $withCount = ['likedByProfiles'];

    public function category(): BelongsTo
    {
        return $this->post->category();
    }

    public function parent(): HasOne
    {
        return $this->hasone(Comment::class, 'parent_id');
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->profile->user();
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function notifications(): MorphMany
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    public function notification():MorphOne
    {
        return $this->morphOne(Notification::class, 'notifiable')->whereNull('read_at');
    }

    public function likedByProfiles()
    {
        return $this->morphToMany(Profile::class, 'likeable', 'likeables');
    }

    public function getNameAttribute()
    {
        return $this->profile->name;
    }

    public function getFormattedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getIsLikedAttribute(): bool
    {
        return $this->likedByProfiles->contains(auth()->user()->profile);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

}
