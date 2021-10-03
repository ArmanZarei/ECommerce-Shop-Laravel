<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AttributeRequest;
use App\Models\Attribute;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::latest()->paginate(20);

        return view('admin.attributes.index', compact('attributes'));
    }

    public function create()
    {
        return view('admin.attributes.create');
    }

    public function store(AttributeRequest $request)
    {
        $attribute = Attribute::create($request->validated());

        notify()->success("Attribute \"$attribute->name\" successfully created.");

        return redirect()->route('admin.attributes.index');
    }

    public function edit(Attribute $attribute)
    {
        return view('admin.attributes.edit', compact('attribute'));
    }

    public function update(AttributeRequest $request, Attribute $attribute)
    {
        $attribute->update($request->validated());

        notify()->success("Attribute \"$attribute->name\" successfully updated.");

        return redirect()->route('admin.attributes.index');
    }
}
