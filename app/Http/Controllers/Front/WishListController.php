<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function toggleProduct(Request $request, Product $product)
    {
        auth()->user()->wishList()->toggle($product->id);

        return "Ok";
    }
}
