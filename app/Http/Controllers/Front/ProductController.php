<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $commentsRate = $product
            ->comments()
            ->join('product_rates', function ($join) {
                $join->on('product_rates.product_id', '=', 'comments.product_id')
                    ->on('product_rates.user_id', '=', 'comments.user_id');
            })
            ->select('comments.id as cid', 'product_rates.rate as rate')
            ->get()->pluck('rate', 'cid')->toArray();

        return view('front.products.show', compact('product', 'commentsRate'));
    }
}
