<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Banner\CreateRequest;
use App\Http\Requests\Admin\Banner\UpdateRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->paginate(10);
        return view('admin.banners.index', compact('banners'));
    }

    public function create(Banner $banner)
    {
        return view('admin.banners.create', compact('banner'));
    }

    public function store(CreateRequest $request)
    {
        $imagePath = $request->file('image')->store('public/'.env('BANNER_IMAGES_PATH'));
        Banner::create($request->only('link', 'priority', 'is_active') + ['image' => basename($imagePath)]);

        notify()->success("Banner successfully created.");

        return redirect()->route('admin.banners.index');
    }

    public function destroy(Banner $banner)
    {
        Storage::delete('public/'.env('BANNER_IMAGES_PATH').$banner->image);
        $banner->delete();

        notify()->success("Banner successfully deleted.");

        return redirect()->route('admin.banners.index');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(UpdateRequest $request, Banner $banner)
    {
        $imageRequest = [];
        if ($request->has('image')) {
            Storage::delete('public/'.env('BANNER_IMAGES_PATH').$banner->image);
            $imagePath = $request->file('image')->store('public/'.env('BANNER_IMAGES_PATH'));
            $imageRequest['image'] = basename($imagePath);
        }

        $banner->update($request->only('link', 'priority', 'is_active') + $imageRequest);

        notify()->success("Banner successfully updated.");

        return redirect()->route('admin.banners.index');
    }
}
