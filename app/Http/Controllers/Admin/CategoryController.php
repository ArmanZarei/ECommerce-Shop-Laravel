<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(20);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $attributes = Attribute::all();

        return view('admin.categories.create', compact('categories', 'attributes'));
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->only(['name', 'description', 'is_active', 'icon', 'parent_id']));

        if (is_array($request->input('attributes'))) {
            $pivotValues = array_map(function ($attributeId) use ($request) {
                return [
                    'is_filter' => in_array($attributeId, $request->input('filterable_attributes') ?? []),
                    'is_variation' => $attributeId == $request->input('variation_attribute'),
                ];
            }, $request->input('attributes'));

            $category->attributes()->attach(
                array_combine($request->input('attributes'), $pivotValues)
            );
        }

        notify()->success("Category \"$category->name\" successfully created.");

        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category)
    {
        $categories = Category::where('id', '!=', $category->id)->get();
        $attributes = Attribute::all();
        $filterableAttributeIds = $category->attributes()->wherePivot('is_filter', true)->get()->pluck('id')->toArray();
        $variationAttrId = $category->attributes()->wherePivot('is_variation', true)->first()?->id;

        return view('admin.categories.edit', compact(
            'category',
            'categories',
            'attributes',
            'filterableAttributeIds',
            'variationAttrId'
        ));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->only(['name', 'description', 'is_active', 'icon', 'parent_id']));

        $attributes = $request->input('attributes') ?? [];

        $pivotValues = array_map(function ($attributeId) use ($request) {
            return [
                'is_filter' => in_array($attributeId, $request->input('filterable_attributes') ?? []),
                'is_variation' => $attributeId == $request->input('variation_attribute'),
            ];
        }, $attributes);

        $category->attributes()->sync(
            array_combine($attributes, $pivotValues)
        );

        notify()->success("Category \"$category->name\" successfully updated.");

        return redirect()->route('admin.categories.index');
    }

    public function getAttributes(Category $category)
    {
        return $category->attributes()->withPivot('is_filter', 'is_variation')->get();
    }
}
