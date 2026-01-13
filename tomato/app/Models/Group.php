<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $title
 * @property int $profile_id
 * @property string|null $description
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Profile> $members
 * @property string|null $avatar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int|null $members_count
 * @property-read \App\Models\Profile $profile
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Group newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Group newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Group query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Group whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Group whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Group whereMembers($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Group whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Group whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Group whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Group extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = false;

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class, 'group_members');
    }

    public function themes(): HasMany
    {
        return $this->hasMany(Theme::class);
    }

    public function user(): BelongsTo
    {
        return $this->profile->user();
    }

    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(
            Profile::class,
            'group_profile'
        );
    }
    public function getIsSubscribedAttribute(): bool
    {
        return $this->subscribers->contains('id', auth()->user()->profile->id);
    }
}
