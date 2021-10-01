<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(20);

        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(BrandRequest $request)
    {
        $brand = Brand::create([
            'name' => $request->input('name'),
            'is_active' => $request->has('is_active'),
        ]);

        notify()->success("Brand \"$brand->name\" successfully created.");

        return redirect()->route('admin.brands.index');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(BrandRequest $request, Brand $brand)
    {
        $brand->update([
            'name' => $request->input('name'),
            'is_active' => $request->has('is_active'),
        ]);

        notify()->success("Brand \"$brand->name\" successfully updated.");

        return redirect()->route('admin.brands.index');
    }
}
