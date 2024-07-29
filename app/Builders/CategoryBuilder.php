<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class CategoryBuilder extends Builder
{
    public function whereIsRoot()
    {
        return $this->where('parent', 0);
    }
}
