<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $theme_id
 * @property int $profile_id
 * @property string|null $body
 * @property int|null $answer_id
 * @property int|null $repost_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read ThemeMessage|null $answer
 * @property-read \App\Models\Profile $profile
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ThemeMessage> $repost
 * @property-read int|null $repost_count
 * @property-read \App\Models\Theme $theme
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ThemeMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ThemeMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ThemeMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ThemeMessage whereAnswerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ThemeMessage whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ThemeMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ThemeMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ThemeMessage whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ThemeMessage whereRepostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ThemeMessage whereThemeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ThemeMessage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ThemeMessage extends Model
{
    use SoftDeletes, HasFactory;
    public function answer(): HasOne
    {
        return $this->hasOne(ThemeMessage::class, 'answer_id');
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function repost(): HasMany
    {
        return $this->hasMany(ThemeMessage::class, 'repost_id');
    }

    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }
}
