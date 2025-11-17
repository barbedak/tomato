<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class AbstractFilter
{
    protected array $keys = [];
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
}
