<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
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

        return view(
            'admin.products.create',
            compact('tags', 'categories', 'brands')
        );
    }

    public function store(Request $request)
    {
//        $request->validate([
//            'main_image2' => 'required',
//        ]);
        dd($request->all());
    }
}
