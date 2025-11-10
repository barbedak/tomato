<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Repost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Repost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Repost query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Repost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Repost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Repost whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Repost whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Repost extends Model
{
    use softDeletes;

}
