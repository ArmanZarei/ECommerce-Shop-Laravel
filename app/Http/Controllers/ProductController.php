<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Rules\Admin\Product\TagIdsExist;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(20);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        $brands = Brand::all();
        $attributes = null;
        if (old('category_id') && in_array(intval(old('category_id')), $categories->pluck('id')->toArray())) {
            $attributes = $categories->where('id', intval(old('category_id')))->first()
                                     ->attributes()->withPivot(['is_filter', 'is_variation'])->get();
        }

//        dd($attributes);

        return view(
            'admin.products.create',
            compact('tags', 'categories', 'brands', 'attributes')
        );
    }

    public function store(ProductRequest $request)
    {
        dd($request->all());
    }
}
