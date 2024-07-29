<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class ProductBuilder extends Builder
{
    public function withAllCategories($arrayIds)
    {
        return $this->whereHas('categories', function ($query) use ($arrayIds) {
            $query->whereIn('categories.id', $arrayIds);
        })->withCount(['categories' => function ($query) use ($arrayIds) {
            $query->whereIn('categories.id', $arrayIds);
        }])->having('categories_count', '=', count($arrayIds));
    }

    public function withAnyCategory($arrayIds)
    {
        return $this->whereRelation('categories', fn ($q) => $q->where('categories.id', $arrayIds));
    }
}
