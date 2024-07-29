<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 * Class Brand
 *
 * @package App\Models
 */
class Brand extends Category
{
    protected $table = 'categories';

    public function getMorphClass()
    {
        return 'App\Models\Category';
    }

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('parent', config('constants.CATEGORY_BRAND_ID'));
        });
    }
}
