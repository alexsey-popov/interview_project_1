<?php
namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * Filter data https://habr.com/ru/post/485520/
     * 
     * @param Builder $builder
     * @param QueryFilter $filter
     */
    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        $filter->apply($builder);
    }
}