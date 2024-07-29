<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function getNestedCategories($queryBuilder = null)
    {
        $queryBuilder = $queryBuilder ?? Category::query();

        $categories = Category::whereIsRoot()
            ->mergeConstraintsFrom($queryBuilder)
            ->orderBy('name')
            ->with(['children' => function ($query) {
                $query->orderBy('name');
            }])
            ->get();
        return $this->buildTree($categories);
    }

    private function buildTree($categories)
    {
        foreach ($categories as $category) {
            $category->children = $this->buildTree($category->children);
        }
        return $categories;
    }
}
