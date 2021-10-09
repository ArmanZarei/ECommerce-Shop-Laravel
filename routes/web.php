<?php

use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin.layouts.master');
});

Route::prefix('/admin')->name('admin.')->group(function () {
    Route::resource('brands', BrandController::class)->except(['destroy', 'show']);
    Route::resource('attributes', AttributeController::class)->except(['destroy', 'show']);
    Route::resource('tags', TagController::class)->except(['destroy', 'show']);
    Route::resource('categories', CategoryController::class)->except(['destroy', 'show']);
    Route::resource('products', ProductController::class)->except(['destroy', 'show']);
});
