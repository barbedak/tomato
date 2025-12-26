<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $profile_id
 * @property int $chat_id
 * @property string|null $body
 * @property int|null $answer_id
 * @property int|null $repost_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Message> $answers
 * @property-read int|null $answers_count
 * @property-read \App\Models\Chat $chat
 * @property-read \App\Models\Profile $profile
 * @property-read Message|null $repost
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereAnswerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereChatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereRepostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Message extends Model
{

    protected $guarded = false;
    use SoftDeletes;

    public function answers(): HasMany
    {
        return $this->HasMany(Message::class);
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function repost(): HasOne
    {
        return $this->hasOne(Message::class);
    }

    public function getAuthorNameAttribute()
    {
        return $this->profile->name;
    }
    public function getFormattedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
