<?php

namespace App\Models;

use App\Events\Log\LogFinishRecordEvent;
use App\Events\Log\LogStartRecordEvent;
use App\Http\Filters\PostFilter;
use App\Http\Resources\Tag\TagResource;
use App\Models\Traits\hasFilter;
use App\Models\Traits\HasLog;
use App\Observers\PostObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

/**
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int|null $category_id
 * @property int|null $profile_id
 * @property string|null $body
 * @property string|null $published_at
 * @property string|null $image_path
 * @property int|null $views
 * @property bool $is_published
 * @property int|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category|null $category
 * @property-read \App\Models\Profile|null $profile
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 * @property-read int|null $tags_count
 * @method static \Database\Factories\PostFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereViews($value)
 * @mixin \Eloquent
 */
//#[ObservedBy(PostObserver::class)]
class Post extends Model
{
    use HasFactory, SoftDeletes, HasLog, HasFilter;

//    protected static function bootHasLog()
//    {
//
//        //что мы хотим сделать created, updated, deleted ...
//
//        static::retrieved(function ($model) {
//            LogStartRecordEvent::dispatch($model, 'retrieved');
//            $model->log()->create([
//                'action' => 'retrieved from Post Model',
//                'attributes' => json_encode($model->attributesToArray())
//            ]);
//            LogFinishRecordEvent::dispatch($model, 'retrieved');
//        });
//
//        static::created(function ($model) {
//            LogStartRecordEvent::dispatch($model, 'created');
//            $model->log()->create([
//                'action' => 'created',
//                'attributes' => json_encode($model->attributesToArray())
//            ]);
//            LogFinishRecordEvent::dispatch($model, 'created');
//        });
//
//        static::updated(function ($model) {
//            LogStartRecordEvent::dispatch($model, 'updated');
//            $attr = $model->getRawOriginal();
//            $new_attr = $model->getDirty();
//            $model->log()->create([
//                'action' => 'updated',
//                'new_attributes' => json_encode($new_attr),
//                'attributes' => json_encode($attr)]);
//            LogFinishRecordEvent::dispatch($model, 'updated');
//        });
//
//
//        static::deleted(function ($model) {
//            LogStartRecordEvent::dispatch($model, 'deleted');
//            $model->log()->create([
//                'action' => 'deleted',
//                'attributes' => json_encode($model->attributesToArray())
//            ]);
//            LogFinishRecordEvent::dispatch($model, 'deleted');
//        });
//
//        parent::booted();
//    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function user(): BelongsTo
    {
        return $this->profile->user();
    }

    public function likes()
    {
        return $this->morphToMany(Profile::class, 'likeable', 'likeables');
    }

    public function views()
    {
        return $this->morphToMany(Profile::class, 'viewable', 'viewables');
    }

    public function getImgUrlAttribute(): string
//        кастомный аттрибут img_url
    {
        return Storage::disk('public')->url($this->image_path);
    }

    public function getTagsAsStringAttribute(): string
    {
//        $tagsTitles = "";
//        $tags = TagResource::collection($this->tags)->resolve();
//        if (!empty($tags)) {
//            foreach ($tags as $tag) {
//                $tagsTitles .= $tag['title']. ',';
//            }
//        }
//        return rtrim($tagsTitles, ',');
        return implode(', ', $this->tags->pluck('title')->toArray());
    }

}
