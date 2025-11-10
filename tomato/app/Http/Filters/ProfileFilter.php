<?php

namespace App\Http\Filters;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ProfileFilter
{
    protected array $keys = [
        'name',
        'user_name',
        'gender',
        'country',
        'birthed_at_from',
        'birthed_at_to',
        'is_married',
        'avatar',
    ];

    public function apply(Builder $builder, array $data): Builder
    {
        foreach ($this->keys as $key) {
            if (isset($data[$key])) {
                $methodName = Str::camel($key);
                $this->$methodName($builder, $data[$key]);
            }
        }
        return $builder;
    }

    private function name(Builder $builder, $value)
    {
        $builder->where('name', 'ilike', "%$value%");
    }

    private function gender(Builder $builder, $value)
    {
        $builder->where('gender', 'ilike', "%$value%");
    }

    private function country(Builder $builder, $value)
    {
        $builder->where('country', 'ilike', "%$value%");
    }

    private function userName(Builder $builder, $value)
    {

        $builder->whereRelation('user','name', 'ilike', "%$value%");
//        $builder->whereHas('user', function (Builder $b) use ($value) {
//            $b->where('name', 'ilike', "%$value%");
//        });
    }

    private function birthedAtFrom(Builder $builder, $value)
    {
        $builder->where('birthed_at', '>=', $value);
    }

    private function birtheddAtTo(Builder $builder, $value)
    {
        $builder->where('birthed_at', '<=', $value);
    }

    private function isMarried(Builder $builder, $value)
    {
        $builder->where('is_married', $value);
    }

    private function avatar(Builder $builder, $value)
    {
        $builder->where('avatar', 'ilike', "%$value%");
    }

}
