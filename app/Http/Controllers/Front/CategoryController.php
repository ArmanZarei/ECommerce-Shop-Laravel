<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $attributes = $category->attributes()->with('values', 'variationValues')->get();
        $filterableAttributes = $attributes->where('pivot.is_filter', true);
        $variation = $attributes->where('pivot.is_variation', true)->first();

        $products = $category->products;

        return view(
            'front.categories.show',
            compact('category', 'products', 'filterableAttributes', 'variation')
        );
    }
}
