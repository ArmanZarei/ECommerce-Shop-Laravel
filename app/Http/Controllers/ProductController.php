<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ProductRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariation;
use App\Models\Tag;
use App\Models\User;
use App\Rules\Admin\Product\TagIdsExist;
use App\Services\Product\ProductAttributesService;
use App\Services\Product\ProductImageService;
use App\Services\Product\ProductVariationsService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct(
        private ProductImageService $productImageService,
        private ProductAttributesService $productAttributesService,
        private ProductVariationsService $productVariationsService,
    ) {}

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

        return view(
            'admin.products.create',
            compact('tags', 'categories', 'brands', 'attributes')
        );
    }

    public function store(ProductRequest $request)
    {
        $primaryImagePath = $request->file('main_image')->store('public/'.env('PRODUCT_IMAGES_PATH'));
        $product = Product::create(array_merge(
            $request->only('name', 'description', 'brand_id', 'category_id', 'is_active'),
            ['primary_image' => basename($primaryImagePath)],
        ));

        $productImages = $this->productImageService->createImagesFromUploadedFiles($product, $request->images ?? []);

        $product->tags()->sync($request->get('tag_ids'));

        $product->load('category.attributes'); // TODO: Check whether it's a single query or multiple
        $categoryAttributes = $product->category->attributes;

        $productAttributes = [];
        foreach ($request->get('attributes') as $attrId => $value)
            if ($categoryAttributes->where('pivot.is_variation', false)->where('id', $attrId)->first())
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

    public function edit($productId)
    {
        $product = Product::with('tags', 'category', 'category.attributes', 'brand', 'attributes', 'images')->findOrFail($productId);
        $tags = Tag::all();
        $categories = Category::all();
        $brands = Brand::all();
        $attributes = $product->category->attributes;
        if (old('category_id') && in_array(intval(old('category_id')), $categories->pluck('id')->toArray())) {
            $attributes = $categories->where('id', intval(old('category_id')))->first()
                ->attributes()->get();
        }

        return view(
            'admin.products.edit',
            compact('product', 'tags', 'categories', 'brands', 'attributes')
        );
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $primaryImagePath = $product->primary_image;
        if ($request->has('main_image')) {
            $primaryImagePath = $request->file('main_image')->store('public/'.env('PRODUCT_IMAGES_PATH'));
            Storage::delete('public/'.env('PRODUCT_IMAGES_PATH').$product->primary_image);
        }
        $product->update(array_merge(
            $request->only('name', 'description', 'brand_id', 'category_id', 'is_active'),
            ['primary_image' => basename($primaryImagePath)],
        ));

        $this->productImageService->updateOldImages($product, $request->get('old_image_ids') ?? []);
        $this->productImageService->createImagesFromUploadedFiles($product, $request->images ?? []);

        $this->productAttributesService->syncProductAttributes($product, $request->get('attributes'));

        $this->productVariationsService->updateAndDeleteOldProductVariations($product, $request->get('old_product_variations') ?? []);
        $this->productVariationsService->createNewProductVariations($product, $request->get('product_variations') ?? []);

        notify()->success("Product successfully updated.");

        return redirect()->back();
    }
}
