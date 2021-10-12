<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Rules\Admin\Product\TagIdsExist;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->latest()->paginate(2);

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
        $primaryImagePath = $request->file('main_image')->store(env('PRODUCT_IMAGES_PATH'));
        $product = Product::create(array_merge(
            $request->only('name', 'description', 'brand_id', 'category_id', 'is_active'),
            ['primary_image' => $primaryImagePath],
        ));

        $productImagesArr = array_map(function (UploadedFile $image) use ($product) {
            $imagePath = $image->store(env('PRODUCT_IMAGES_PATH'));

            return [
                'product_id' => $product->id,
                'image' => $imagePath,
            ];
        }, $request->images);
        $productImages = $product->images()->createMany($productImagesArr);

        $product->tags()->sync($request->get('tag_ids'));


        $product->load('category.attributes'); // TODO: Check whether it's a single query or multiple
        $categoryAttributes = $product->category->attributes;

        $productAttributes = [];
        foreach ($request->get('attributes') as $attrId => $value)
            if ($categoryAttributes->where('pivot.is_filter', true)->where('id', $attrId)->first())
                $productAttributes[$attrId] = ['value' => $value];
        if ($productAttributes)
            $product->attributes()->sync($productAttributes);

        if ($variationAttr = $categoryAttributes->where('pivot.is_variation', true)->first()) {
            $product->variations()->createMany(array_map(function ($variation) use ($variationAttr) {
                return $variation + ['attribute_id' => $variationAttr->id];
            }, $request->get('product_variations')));
        }


        notify()->success("Product \"$product->name\" successfully updated.");

        return redirect()->route('admin.products.index');
    }
}
