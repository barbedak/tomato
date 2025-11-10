<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class PostFilter
{
    protected array $keys = [
        'title',
        'category_title',
        'published_at_from',
        'published_at_to',
        'views_from',
        'views_to',
    ];

    public function apply(Builder $builder, array $data): Builder
    {
        foreach ($this->keys as $key) {
            if (isset($data[$key])){
                  $methodName = Str::camel($key);
                  $this->$methodName($builder, $data[$key]);
            }
        }
        return $builder;
    }
    private function title(Builder $builder, $value)
    {
        $builder->where('title', 'ilike', "%$value%");
    }

    private function categoryTitle(Builder $builder, $value)
    {
//        $builder->whereRelation('category','title', 'ilike', "%$value%");
        $builder->whereHas('category',function(Builder $b) use ($value){
            $b->where('title', 'ilike', "%$value%");
        });
    }

    private function publishedAtFrom(Builder $builder, $value)
    {
        $builder->where('published_at', '>=', $value);
    }

    private function publishedAtTo(Builder $builder, $value)
    {
        $builder->where('published_at', '<=', $value);
    }

    private function viewsFrom(Builder $builder, $value)
    {
        $builder->where('views_from', 'ilike', $value);
    }

    private function viewsTo(Builder $builder, $value)
    {
        $builder->where('views_to', 'ilike', $value);
    }

}
