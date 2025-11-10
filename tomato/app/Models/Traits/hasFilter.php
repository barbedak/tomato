<?php

namespace App\Models\Traits;

use App\Http\Filters\PostFilter;
use Illuminate\Database\Eloquent\Builder;

trait hasFilter
{
    //дз comment, category, profile
//    Post::filter
    public function scopeFilter(Builder $builder, array $data): Builder
    {
        $ClassName= 'App\\Http\\Filters\\'.class_basename($this).'Filter';
        return (new $ClassName())->apply($builder, $data);
    }
}
