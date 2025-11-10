<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class CommentFilter
{
    protected array $keys = [
        'body',
        'profile_name'
    ];

    public function apply(Builder $builder, $data): Builder
    {
        foreach ($this->keys as $key) {
            if (isset($data[$key])) {
                $methodName = Str::camel($key);
                $this->$methodName($builder, $data[$key]);
            }
        }
        return $builder;
    }

    private function body(Builder $builder, $value): void
    {
        $builder->where('body', 'ilike', "%$value%");
    }

    private function profileName(Builder $builder, $value): void
    {
       $builder->whereRelation('profile', 'name','ilike', "%$value%");
//        $builder->whereHas('commentable', function (Builder $b) use ($value) {
//            $b->whereRelation('profile', 'name', 'ilike', "%$value%");
//        });
    }

}
