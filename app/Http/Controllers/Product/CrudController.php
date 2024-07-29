<?php

namespace App\Http\Controllers\Product;

use App\Apis\Woocommerce\WcProductApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFindRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Automattic\WooCommerce\HttpClient\HttpClientException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductFindRequest $request)
    {
        $products = Product::orderBy('supplier_id')
            ->where('description', 'Like', '%' .  $request->input('description') . '%');

        foreach ($request->only(['supplier_id', 'relative_code', 'status']) as $field => $value) {
            if (is_null($value)) continue;
            $products->where($field, $value);
        }

        if (is_null($request->category_id) === false && is_array($request->category_id)) {
            if (in_array(355, $request->category_id)) {
                $excludedCategories = Category::where('parent', 46)->pluck('id')->toArray();

                $products = $products->whereDoesntHave('categories', function ($query) use ($excludedCategories) {
                    $query->whereIn('category_id', $excludedCategories);
                });
            } else {
                $products = $products->withAllCategories($request->category_id);
            }
        }
        $products = $products->paginate(50)->withQueryString();
        return view('products.crud.index', compact('products'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.crud.show', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('products.crud.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request, ProductService $productService): RedirectResponse
    {
        try {
            $product = $productService->store($request);
            return redirect()->route('products.crud.create')
                ->with('status', 'success')
                ->with('msg', 'Producto ID: ' . $product->id . ' COD: ' . $product->sku . ' creado correctamente local y en la tienda');
        } catch (HttpClientException $e) {
            Log::error("CrudController->store: " . $e->getMessage());
            Log::error($e);

            $validator = Validator::make([], []);
            $validator->errors()->add('CrudController->store', $e->getMessage());

            return redirect()->route('products.crud.create')
                ->withErrors($validator)
                ->withInput();
        }
    }
}
