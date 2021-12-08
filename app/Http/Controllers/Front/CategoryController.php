<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\ProductsSearchService;

class CategoryController extends Controller
{
    public function __construct(private ProductsSearchService $productSearchService) {}

    public function show(Request $request, Category $category)
    {
        $attributes = $category->attributes()->with('values', 'variationValues')->get();
        $filterableAttributes = $attributes->where('pivot.is_filter', true);
        $variation = $attributes->where('pivot.is_variation', true)->first();

        $products = $this->productSearchService->search($request, $category);

        return view(
            'front.categories.show',
            compact('category', 'products', 'filterableAttributes', 'variation')
        );
    }
}
