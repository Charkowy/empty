<?php

namespace App\Http\Controllers;

use App\Apis\Woocommerce\WcCategoryApi;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(CategoryService $categoryService)
    {
        $categories = $categoryService->getNestedCategories();
        return view('categories.index', compact('categories'));
    }
}
